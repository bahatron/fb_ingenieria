import $errorFactory from "./ErrorFactory";
import $errorHandler from "./ErrorHandler";

export interface Exception {
    type: string;
    statusCode: number;
    message: any;
    stack?: string;
}

const $error = {
    ...$errorFactory,
    handle: $errorHandler.handle,
};

export default $error;
