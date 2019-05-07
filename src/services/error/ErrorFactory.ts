import { Exception } from ".";

interface FactoryParameters {
    httpCode: number;
    message: string;
}

function factory({ httpCode, message }: FactoryParameters): Exception {
    const error = Object.assign(new Error(), {
        httpCode,
        message,
    });

    return error;
}

const $errorFactory = {
    ValidationFailed(message = "Validation failed"): Exception {
        return factory({ httpCode: 400, message });
    },

    NotFound(message = "Not found"): Exception {
        return factory({ httpCode: 404, message });
    },

    InternalError(message = "Internal error"): Exception {
        return factory({ httpCode: 500, message });
    },
};

export default $errorFactory;
