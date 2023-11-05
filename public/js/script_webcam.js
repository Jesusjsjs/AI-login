const video = document.getElementById('inputVideo');
const canvas = document.getElementById('overlay');

(async () => {
    const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
})();

setTimeout(() => onPlay(), 2000);

async function onPlay() {


    const MODEL_URL = 'public/models/';

    await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
    await faceapi.loadFaceLandmarkModel(MODEL_URL);
    await faceapi.loadFaceRecognitionModel(MODEL_URL);
    await faceapi.loadFaceExpressionModel(MODEL_URL);

    let fullFaceDescriptions = await faceapi.detectAllFaces(video)
        .withFaceLandmarks()
        .withFaceDescriptors()
    .withFaceExpressions();

    const dims = faceapi.matchDimensions(canvas, video, true);
    const resizedResults = faceapi.resizeResults(fullFaceDescriptions, dims);

    faceapi.draw.drawDetections(canvas, resizedResults);
    faceapi.draw.drawFaceLandmarks(canvas, resizedResults);
    // faceapi.draw.drawFaceExpressions(canvas, resizedResults, 0.05);


    const faceMatcher = new faceapi.FaceMatcher(fullFaceDescriptions);
    //Lo comparamos con la siguiente img

    //El nombre de esta variable debería llegar en el post
    const img2 = await faceapi.fetchImage(`http://localhost:80/loginFaceIRDProject/public/img/imgUsers/jesusjefe.jpg`);

    // console.log( img2 );     

    const singleResult = await faceapi
    .detectSingleFace( img2 )
    .withFaceLandmarks()
    .withFaceDescriptor()
    


    if (singleResult) {
        const bestMatch = faceMatcher.findBestMatch(singleResult.descriptor)
        // console.log(bestMatch._distance)
        console.log(bestMatch._distance);
        

        if(bestMatch._distance > 0.4  ){
            console.log( "Aprobado" );
        }
        else{
            console.log( "No aprobado" );
        }
    }


}

