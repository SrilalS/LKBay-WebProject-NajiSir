var config = {
    apiKey: "AIzaSyCQrMvPq8g9F4TDlKSjQo7XUqZY3FSAHi4",
    authDomain: "lkbay-bd5eb.firebaseapp.com",
    databaseURL: "https://lkbay-bd5eb.firebaseio.com",
    projectId: "lkbay-bd5eb",
    storageBucket: "lkbay-bd5eb.appspot.com",
    messagingSenderId: "427798602943",
    appId: "1:427798602943:web:cb61f3416040ec1869520a",
    measurementId: "G-0C7T20RMG2"
};


firebase.initializeApp(config);
var firestore = firebase.firestore();


var docRefC = firestore.doc("BUYERS/COUNT");

const email = document.querySelector("#email");
const name = document.querySelector("#name");
const pws = document.querySelector("#password");
const bd = document.querySelector("#bday");
const ad = document.querySelector("#address");
const regbtn = document.querySelector("#regbtn");
var check = document.querySelector("#seller");
var mforum = document.querySelector("#Mforum");
var count;

var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

var checkbox = document.querySelector("#seller");
var sellerS = 0;
checkbox.addEventListener('change', function() {
    if (this.checked) {
        console.log("1");
        sellerS = 1;
    } else {
        console.log("0");
        sellerS = 0;
    }
});


var alertDiv = document.querySelector("#headings");

docRefC.get().then(function(docC) {
    var precount = docC.data();
    count = parseInt(precount.C);
    count = count + 1;
    console.log(count);
}).then(function() {

    var docRef = firestore.doc("BUYERS/" + count);
    regbtn.addEventListener("click", function() {

        const nameS = name.value;
        const emailS = email.value;
        const pwsS = pws.value;
        const bdS = bd.value;
        const addS = ad.value;
        if (nameS !== "" && emailS !== "" && pwsS !== "" && bdS !== "" && addS !== "" && re.test(emailS) == true) {

            alertDiv.innerHTML = "Registering...";
            mforum.parentNode.removeChild(mforum);


            docRef.set({
                N: nameS,
                P: pwsS,
                AD: addS,
                BD: bdS,
                E: emailS,
                S: sellerS,
            }).then(function() {
                console.log("Saved!");
                docRefC.set({
                    C: count,
                }).then(function() {
                    location.href = 'regconf.php';
                });
            })
        }
    });
})