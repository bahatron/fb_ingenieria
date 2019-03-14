const thang = new String("thang");
const theng = String("theng");
const thing = "thing";
const thong = String({ rick: "sanchez" });
const thung = new String({ rick: "sanchez" });

console.log(thang, typeof thang); // [String: 'thang'] 'object
console.log(theng, typeof theng); // theng string
console.log(thing, typeof thing); // thing string
console.log(thong, typeof thong); // [object Object] string
console.log(thung, typeof thung); // [String: '[object Object]'] 'object'

console.log({}.toString(), typeof {}.toString()); // [object Object] string
console.log("abc".toString(), typeof "abc".toString()); // abc string
console.log([1, 2, 3].toString(), typeof [1, 2, 3].toString()); // 1,2,3 string
console.log((5).toString(), typeof (5).toString()); // 5 string

console.log(`thang is ${thang}`); // thang is thang
console.log(`theng is ${thang}`); // theng is theng
console.log(`thing is ${thang}`); // thing is thing
console.log(`thong is ${thong}`); // thong is [object Object]
console.log(`thung is ${thung}`); // thung is [object Object]
console.log(thong === "[object Object]");
