import "./sentry.config";
import { expect } from "chai";
import $errorFactory from "../../domain/error/ErrorFactory";

const func = $errorFactory.isError;
$errorFactory.isError = function (err: any) {
    expect(true).to.be.true;
    return func(err);
};

describe("ErrorFactory", () => {
    it("will check if error is own", () => {
        const error = $errorFactory.ValidationException("message");

        expect($errorFactory.isError(error)).to.be.true;
    });
});
