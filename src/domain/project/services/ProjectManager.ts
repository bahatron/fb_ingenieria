import $database, { Model } from "../../../services/Database";
import {
    ProjectData, PROJECT_TYPES, PROJECT_COUNTRIES, PROJECT_AREAS,
} from "..";
import $error from "../../../services/error";
import $storage, { FileRecord } from "../../../services/Storage";

const UUID: any = require("uuid");

const PATH = "/projects";

/** @todo improve validation */
function validator(data: any): ProjectData {
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
    } = data;

    if (!clientId) {
        throw $error.ValidationFailed("client id is required");
    }

    if (!name) {
        throw $error.ValidationFailed("name is required");
    }

    if (!PROJECT_COUNTRIES.includes(country)) {
        throw $error.ValidationFailed(`${country} is not valid`);
    }

    if (!PROJECT_TYPES.includes(type)) {
        throw $error.ValidationFailed(`${type} is not a valid project type`);
    }

    if (!PROJECT_AREAS.includes(area)) {
        throw $error.ValidationFailed(`${area} is not a valid project area`);
    }

    return {
        clientId,
        name,
        country,
        area,
        type,
        shortDescription,
        longDescription,
        images,
        visible: Boolean(visible),
    };
}

async function mapImageRecords(images?: string[]): Promise<FileRecord[]> {
    if (!Array.isArray(images)) {
        return [];
    }

    return Promise.all(images.map(uid => $storage.get(uid)));
}

export interface ProjectRecord {
    on(event: "value", cb: (data: ProjectData) => void): void;
    delete(): Promise<void>;
    update(data: Partial<ProjectData>): ProjectRecord;
    save(): Promise<void>;
    addImage(file: File): Promise<void>;
    imageUrls(): string[];
}

interface projectFactory {
    record: Model<ProjectData>;
    isNew: boolean;
    data?: Partial<ProjectData>;
}
async function projectFactory({ record, isNew, data }: projectFactory): Promise<ProjectRecord> {
    let $projectData: Partial<ProjectData> = data || {};

    const $projectImages: FileRecord[] = await mapImageRecords($projectData.images);

    record.on("value", (projectData) => {
        $projectData = projectData;
    });

    return {
        on: record.on,

        async delete() {
            await Promise.all(
                $projectImages.map(async record => record.delete()).concat([record.delete()]),
            );
        },

        update(this: ProjectRecord, data: Partial<ProjectData>): ProjectRecord {
            /** @todo: deepMerge */
            $projectData = { ...$projectData, ...data };

            return this;
        },

        async save(): Promise<void> {
            const validatedData = validator($projectData);
            if (isNew) {
                await record.set(validatedData);

                isNew = false;
                return;
            }

            await record.update(validatedData);
        },

        async addImage(this: ProjectRecord, image: File): Promise<void> {
            // if the record is new, validate that it can be saved
            if (isNew) {
                validator($projectData);
            }

            const fileRecord = await $storage.upload(image);

            $projectImages.push(fileRecord);

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

        imageUrls(): string[] {
            return $projectImages.map(record => record.url);
        },
    };
}

interface create {
    data?: any;
}

const $projectManager = {
    async create({ data }: create) {
        const uid = UUID.v4();

        const record = await $database.new({ path: PATH, id: uid, validator });

        return projectFactory({ record, isNew: true, data });
    },

    async all() {
        const dataRefs = await $database.fetch<ProjectData>({ path: PATH, validator });

        return dataRefs.map(record => projectFactory({ record, isNew: false }));
    },
};

export default $projectManager;
