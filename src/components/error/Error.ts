export interface AppError {
    type: string;
    statusCode: number;
    message: any;
    stack?: string;
}

function createError(type: string, statusCode: number, message: any): Error {
    const error = Object.assign(new Error(), {
        name: type,
        type,
        statusCode,
        message,
    });

    return error;
}

const $error = {
    ValidationException(message: string): Error {
        return createError("ValidationException", 400, message);
    },
};

export default $error;
