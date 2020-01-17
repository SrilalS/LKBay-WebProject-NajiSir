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

const add = document.querySelector("#addbtn");
const ref = firebase.storage().ref('PIMG');
var firestore = firebase.firestore();
var docRefC = firestore.doc("ITEMS/COUNT");
var emls = document.querySelector("#eml").innerHTML;
console.log(emls);

docRefC.get().then(function(docC) {
    var precount = docC.data();
    count = parseInt(precount.C);
    count = count + 1;
    console.log(count);
});

var furl = '';

add.addEventListener('click', function() {
    const pname = document.querySelector("#name").value;
    const price = document.querySelector("#price").value;
    const desc = document.querySelector("#desc").value;
    const comp = document.querySelector("#comp").value;


    var alertDiv = document.querySelector("#headings");
    var mforum = document.querySelector("#Mforum");

    const nameS = pname.value;
    const priceS = price.value;
    const compS = comp.value;
    const descS = desc.value;

    var file = document.querySelector('#file').files[0];
    console.log(file);
    const name = count + '.jpg';
    const metadata = {
        contentType: file.type
    };
    const task = ref.child(name).put(file, metadata);
    task.on("state_changed", function(snapshot) {

        alertDiv.innerHTML = "Adding...";
        mforum.parentNode.removeChild(mforum);
        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
        console.log('Upload is ' + progress + '% done');
        docRefC.set({
            C: count,
        });
    });
    task
        .then(snapshot => snapshot.ref.getDownloadURL())
        .then((url) => {
            furl = url;
            console.log(furl);
            var docRef = firestore.doc("ITEMS/ALL/ITEMS/" + count);

            docRef.set({
                N: pname,
                P: price,
                C: comp,
                D: desc,
                U: furl,
                E: emls,
                DEL: '0',
            });
        }).then(function() {
            location.href = 'addconf.php';
        })
});