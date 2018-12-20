import $sentry from "./sentry";

export interface AppError {
    type: string;
    statusCode: number;
    message: any;
    stack?: string;
}

function createError(type: string, statusCode: number, message: any): AppError {
    const error = Object.assign(new Error(), {
        name: type,
        type,
        statusCode,
        message,
    });

    return error;
}

const $error = {
    handle(err: any): any {
        $sentry.captureException(err);
    },

    ValidationException(message: string): AppError {
        return createError("ValidationException", 400, message);
    },
};

export default $error;
