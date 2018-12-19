import $error from "../../error/Error";
import { ClientData } from "../ClientFacade";

const $clientValidator = {
    validate(data: any): ClientData {
        const {
            name, website, description, visible, image,
        } = data;

        if (!name || typeof visible !== "boolean") {
            throw $error.ValidationException("'name' and 'visible' are required");
        }

        return {
            name,
            visible,
            image: image || null,
            website: website || null,
            description: description || null,
        };
    },
};

export default $clientValidator;
