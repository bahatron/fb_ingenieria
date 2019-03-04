import { Exception } from ".";

function factory(type: string, statusCode: number, message: any): Exception {
    const error = Object.assign(new Error(), {
        name: type,
        type,
        statusCode,
        message,
    });

    return error;
}

const $errorFactory = {
    ValidationFailed(message = "Validation failed"): Exception {
        return factory("ValidationFailed", 400, message);
    },

    NotFound(message = "Not found"): Exception {
        return factory("NotFound", 404, message);
    },
};

export default $errorFactory;
