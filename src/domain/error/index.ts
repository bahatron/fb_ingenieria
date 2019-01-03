import $errorHandler from "./ErrorHandler";
import $errorFactory from "./ErrorFactory";

export interface AppError {
    type: string;
    statusCode: number;
    message: any;
    stack?: string;
}

const $error = {
    handle: $errorHandler.handle,
    ...$errorFactory,
};

export default $error;
