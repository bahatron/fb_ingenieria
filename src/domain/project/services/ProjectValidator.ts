import { ProjectData } from "..";
import $error from "../../error";

const $projectValidator = {
    async validate(data: any): Promise<ProjectData> {
        let {
            name,
            shortDescription,
            longDescription,
            visible,
            clientId,
            country,
            area,
            type,
            images,
        } = data;

        /** @todo: find a more elegant way to do this */
        if (!name || typeof visible !== "boolean" || !clientId || !country || !area || !type) {
            throw $error.ValidationException("Project data not sufficient");
        }

        if (!images || !Array.isArray(images)) {
            images = [];
        }

        return {
            clientId,
            name,
            visible,
            country,
            area,
            type,
            shortDescription,
            longDescription,
            images,
        };
    },
};

export default $projectValidator;
