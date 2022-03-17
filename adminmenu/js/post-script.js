let updatePostEvent = document.querySelectorAll(".update-this-item");

updatePostEvent.forEach((e) => {

    e.addEventListener("click", (e) => {

        e.preventDefault();

        let postId = e.target.getAttribute("date-attributes");

        let pluginUrl = e.target.getAttribute("plugin-url");

        let token = document.querySelector('.jtl_token').value;

        let sentData = { "post_id": postId };

        let headers = {
            Accept: "application/json",
            "Content-Type": "application/json",
            jtlToken: token,
        };

        let url = pluginUrl + 'ressource';
        const basUrl = url + '?fetch=get-post',
            httpRequest = new HttpRequest(basUrl, headers);

        const postData = httpRequest.post(basUrl, sentData);

        postData.then((data) => {
            let post = data.data.post;

            document.getElementById("posteditmodal").click();
            document.getElementById("postId").value = post.id;
            document.getElementById("post-title").value = post.title;
            document.getElementById("post-body").textContent = post.body;
        });
    })
})
