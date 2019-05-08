import $database, { Model } from "../../../services/Database";
import { ProjectData, PROJECT_TYPES, PROJECT_COUNTRIES, PROJECT_AREAS } from "..";
import $error from "../../../services/error";
import $storage, { FileRecord } from "../../../services/Storage";

const UUID: any = require("uuid");

const PATH = "/projects";

/** @todo: generalize this interface */
interface Callback {
    (data: ProjectData): void;
}

export type ProjectRecordEvents = "updated" | "deleted" | "created";

export interface ProjectRecord {
    readonly data: Partial<ProjectData>;
    readonly uid: string;
    imageUrls(): string[];
    on(event: ProjectRecordEvents, cb: Callback): void;
    delete(): Promise<void>;
    update(data: Partial<ProjectData>): ProjectRecord;
    save(): Promise<void>;
    addImage(file: File): Promise<void>;
    deleteImage(id: string): Promise<void>;
}

/** @todo improve validation */
function validateProject(data: any): ProjectData {
    const {
        clientId,
        name,
        country,
        area,
        type,
        visible,
        shortDescription,
        longDescription,
        images,
        uid,
    } = data;

    if (!clientId) {
        throw $error.ValidationFailed("Campo Cliente es obligatorio");
    }

    if (!name) {
        throw $error.ValidationFailed("Campo Nombre es obligatorio");
    }

    if (!PROJECT_COUNTRIES.includes(country)) {
        throw $error.ValidationFailed(`Campo Pais es obligatorio`);
    }

    if (!PROJECT_TYPES.includes(type)) {
        throw $error.ValidationFailed(`Campo Tipo es obligatorio`);
    }

    if (!PROJECT_AREAS.includes(area)) {
        throw $error.ValidationFailed(`Campo Area es obligatorio`);
    }

    return {
        uid,
        clientId,
        name,
        country,
        area,
        type,
        shortDescription: shortDescription || "",
        longDescription: longDescription || "",
        images: images || [],
        visible: Boolean(visible),
    };
}

async function mapImageRecords(images?: string[]): Promise<Record<string, FileRecord>> {
    if (!Array.isArray(images)) {
        return {};
    }

    const array = await Promise.all(images.map(uid => $storage.get(uid)));

    return array.reduce((carry: Record<string, FileRecord>, file) => {
        carry[file.id] = file;

        return carry;
    }, {});
}

interface createProject {
    isNew: boolean;
    record: Model<ProjectData>;
    images: Record<string, FileRecord>;
    data: Partial<ProjectData>;
}
function ProjectRecord({ record, images, isNew, data }: createProject): ProjectRecord {
    const $projectData: Partial<ProjectData> = Object.assign(data, {
        uid: record.id,
    });

    const $projectImages = images;

    const $callbacks: Record<ProjectRecordEvents, Callback[]> = {
        updated: [],
        deleted: [],
        created: [],
    };

    function processEvents(eventType: ProjectRecordEvents) {
        $callbacks[eventType].forEach(cb => cb(<ProjectData>$projectData));
    }
    return {
        on(event, callback) {
            if (event === "updated") {
                record.on("value", callback);
            } else {
                $callbacks[event].push(callback.bind(this));
            }
        },

        async delete() {
            await Promise.all(
                Object.values($projectImages)
                    .map(async record => record.delete())
                    .concat([record.delete()]),
            );

            processEvents("deleted");
        },

        update(this: ProjectRecord, data: Partial<ProjectData>): ProjectRecord {
            if (data.uid && data.uid !== this.uid) {
                throw $error.ValidationFailed("UID mismatch");
            }

            /** @todo: deepMerge */
            Object.assign($projectData, data);

            return this;
        },

        async save(): Promise<void> {
            Object.assign($projectData, validateProject($projectData));
            if (isNew) {
                await record.set(<ProjectData>$projectData);
                isNew = false;

                return processEvents("created");
            }

            await record.update($projectData);
        },

        async addImage(this: ProjectRecord, image: File): Promise<void> {
            // if the record is new, validate that it can be saved
            if (isNew) {
                validateProject($projectData);
            }

            const fileRecord = await $storage.upload(image);
            $projectImages[fileRecord.id] = fileRecord;
            const images = $projectData.images || [];
            images.push(fileRecord.id);
            $projectData.images = images;

            try {
                await this.save();
            } catch (err) {
                // delete image if there was an error attaching image uid to project
                await record.delete();
                throw err;
            }
        },

        async deleteImage(this: ProjectRecord, imageId: string): Promise<void> {
            const fileRecord = $projectImages[imageId];

            if (!fileRecord) {
                return;
            }

            const images = $projectData.images || [];
            $projectData.images = images.filter(value => value !== imageId);

            /** @todo: inconsistant state if there's an error here */
            await Promise.all([this.save(), fileRecord.delete()]);
        },

        imageUrls(): string[] {
            return Object.values($projectImages).map(record => record.url);
        },

        get data() {
            return Object.assign({}, $projectData);
        },

        get uid(): string {
            return record.id;
        },
    };
}

interface projectFactory {
    record: Model<ProjectData>;
    isNew: boolean;
}
async function projectFactory({ record, isNew }: projectFactory): Promise<ProjectRecord> {
    const recordData: Partial<ProjectData> = (await record.data()) || {};
    const images = await mapImageRecords(recordData.images);

    return ProjectRecord({
        record,
        isNew,
        images,
        data: recordData,
    });
}

const $projectManager = {
    async create(data?: ProjectData) {
        const uid = UUID.v4();

        const record = await $database.new<ProjectData>({ path: PATH, id: uid });

        const project = await projectFactory({ record, isNew: true });

        if (data) {
            project.update(data);
        }

        return project;
    },

    async all() {
        const dataRefs = await $database.fetch<ProjectData>({ path: PATH });

        return Promise.all(dataRefs.map(async record => projectFactory({ record, isNew: false })));
    },
};

export default $projectManager;
