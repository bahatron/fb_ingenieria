import $errorFactory from "./ErrorFactory";
import "../../adapters/sentry"; // error handler

export interface Exception {
    httpCode: number;
    message: string;
    stack?: string;
}

const $error = {
    ...$errorFactory,
};

export default $error;
