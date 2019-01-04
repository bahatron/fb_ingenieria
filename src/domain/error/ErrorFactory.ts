import { AppError } from ".";

const $proto = {};

Object.setPrototypeOf($proto, Error.prototype);

function createError(type: string, statusCode: number, message: any): AppError {
    const error = Object.assign(new Error(), {
        name: type,
        type,
        statusCode,
        message,
    });

    Object.setPrototypeOf(error, $proto);

    return error;
}

const $errorFactory = {
    isError(err: any): boolean {
        return Object.getPrototypeOf(err) === $proto;
    },

    ValidationException(message: string): AppError {
        return createError("ValidationException", 400, message);
    },
};

export default $errorFactory;
