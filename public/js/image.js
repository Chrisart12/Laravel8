document.addEventListener('DOMContentLoaded', () => {

    //Function ajax permettant d'envoyer l'image en back-end
    const uploadImage = (image, url) => {

        let token = document.querySelector('meta[name="csrf-token"]').content;

        // let url =  Myjavascript.projet_url + "upload_image";

        fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },

            method: 'post',
            body: JSON.stringify({
                image: image,
            })

        }).then(response => {

            response.json().then(data => {
                window.location.href = Myjavascript.projet_url + "image";
                // console.log(data)
            })


        }).catch(error => {
            console.log(error)
        })
    }

const image_form = document.querySelector("#image_form")
if(image_form) {

    image_form.addEventListener('submit', function(e) {
        e.preventDefault();

        const url = this.action

        // On va rechercher l'image
        const file = document.querySelector("#image").files[0];

        if(!file) return;

        const reader = new FileReader();

        reader.readAsDataURL(file);

        reader.onload = function(event) {
            const imgElment  =  document.createElement('img')
            imgElment.src = event.target.result;

            imgElment.onload = function(e) {
                const canvas = document.createElement("canvas");

                const MAX_WIDTH = 400;

                const scaleSize = MAX_WIDTH / e.target.width;
                canvas.width = MAX_WIDTH;
                canvas.height = e.target.height * scaleSize;

                const ctx = canvas.getContext("2d");
                ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
                // console.log("original", e.target)

                const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");
                console.log("minimisée",srcEncoded)

                uploadImage(srcEncoded, url);

            }
        }
    })

}


    // const submit_image = document.querySelector('#submit_image');
    //     if(submit_image) {

            // submit_image.addEventListener('click', function() {



            // })
        // }

})
