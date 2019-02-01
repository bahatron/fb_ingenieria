import "../../adapters/sentry";

import $errorFactory from "./ErrorFactory";

export interface Exception {
    type: string;
    statusCode: number;
    message: any;
    stack?: string;
}

const $error = {
    ...$errorFactory,
};

export default $error;
