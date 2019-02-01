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
    ValidationFailed(message: string): Exception {
        return factory("ValidationFailed", 400, message);
    },

    NotFound(message: string): Exception {
        return factory("NotFound", 404, message);
    },
};

export default $errorFactory;
