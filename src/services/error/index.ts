import $errorFactory from "./ErrorFactory";

/**
 * @todo customize error handler
 * What we really want is to be able catch any error that is thrown
 * and be able to specify which catched errors goes to the notification system
 */
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
