/**
 * Add New Item Ajax Request Handler JS
 */

(function(){
	const username = document.querySelector(".odir_uname") ?? '';
	const usernameContainer = document.querySelector(".odir-username-container");
	const postdata = document.querySelector(".odir_post");
	const submitBtn = document.querySelector(".odir_submit");

	try {
		submitBtn.addEventListener("click", async () => {
			const data = new FormData();
			data.append("username", (username?.value ?? odir_ajax.username));
			data.append("post", postdata.value);
			data.append("nonce", odir_ajax?.nonce);
			data.append("action", "opendirectory_add_item");
			data.append("logged_in", odir_ajax?.logged_in);
			data.append("is_admin", odir_ajax?.is_admin);

			const response = await fetch(odir_ajax.url, {
				method: "POST",
				body: data
			});

			const result = await response.json();

			if(result.success) {
				console.log("Updated");
				username.value = '';
				postdata.value = '';
				/**
				 * Username container will removed later when for unknown user there will be cookies
				 */
				// usernameContainer?.remove();
			}
		});
	}catch(e) {
		console.log("Not Updated", e);
	}


})()