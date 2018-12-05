import { expect } from "chai";

// import { shallowMount } from "@vue/test-utils";
// import HelloWorld from "@/components/HelloWorld.vue";

// describe("HelloWorld.vue", () => {
//     it("renders props.msg when passed", () => {
//         const msg = "new message";
//         const wrapper = shallowMount(HelloWorld, {
//             propsData: { msg },
//         });
//         expect(wrapper.text()).to.include(msg);
//     });
// });

describe("Array", () => {
    describe("#indexOf()", () => {
        it("should return -1 when the value is not present", () => {
            expect([1, 2, 3].indexOf(4)).to.be.equal(-1);
        });
    });
});
