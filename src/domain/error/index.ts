import $errorFactory from "./ErrorFactory";
import $errorHandler from "./ErrorHandler";

export interface Exception {
    statusCode: number;
    message: string;
    stack?: string;
}

const $error = {
    ...$errorFactory,
    handle: $errorHandler.handle,
};

export default $error;
