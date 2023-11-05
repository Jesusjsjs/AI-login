const MODEL_URL = '/public/models';

(async () => {
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL)
    await faceapi.loadFaceLandmarkModel(MODEL_URL)
    await faceapi.loadFaceRecognitionModel(MODEL_URL)
    await faceapi.loadFaceExpressionModel(MODEL_URL)

    const image = document.getElementById('image');
    const canvas = document.getElementById('canvas');

    let fullFaceVectors = await faceapi
        .detectAllFaces(image)
        .withFaceLandmarks()
    .withFaceDescriptors()
    // .withFaceExpressions();

    


    faceapi.draw.drawDetections(canvas, fullFaceVectors);
    faceapi.draw.drawFaceLandmarks(canvas, fullFaceVectors);
    // faceapi.draw.drawFaceExpressions(canvas, fullFaceVectors, 0.05);

    const faceMatcher = new faceapi.FaceMatcher(fullFaceVectors)

    //Lo comparamos con la siguiente img

    const img2 = await faceapi.fetchImage(`http://localhost:5501/public/images/jesusjefe.jpg`);

    console.log( img2 );

    const singleResult = await faceapi
    .detectSingleFace( img2 )
    .withFaceLandmarks()
    .withFaceDescriptor()

    if (singleResult) {
        const bestMatch = faceMatcher.findBestMatch(singleResult.descriptor)
        console.log(bestMatch.toString())
    }


})();