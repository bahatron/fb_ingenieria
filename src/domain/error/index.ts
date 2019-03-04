import $errorFactory from "./ErrorFactory";
import "../../adapters/sentry"; // error handler

export interface Exception {
    statusCode: number;
    message: string;
    stack?: string;
}

const $error = {
    ...$errorFactory,
};

export default $error;
