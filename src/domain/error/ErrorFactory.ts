import { Exception } from ".";

interface FactoryParameters {
    statusCode: number;
    message: string;
}

function factory({ statusCode, message }: FactoryParameters): Exception {
    const error = Object.assign(new Error(), {
        statusCode,
        message,
    });

    return error;
}

const $errorFactory = {
    ValidationFailed(message = "Validation failed"): Exception {
        return factory({ statusCode: 400, message });
    },

    NotFound(message = "Not found"): Exception {
        return factory({ statusCode: 404, message });
    },
};

export default $errorFactory;
