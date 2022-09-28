const loadPosts = () => {
  window.Alpine.data("loadPosts", (ref) => ({
    action_url: ref.getAttribute("data-action-url"),
    formData: {
      action: ref.getAttribute("data-action"),
      nonce: ref.getAttribute("data-nonce"),
      referer: ref.getAttribute("data-referer"),
      fields: {},
    },
    loading: false,
    load() {
      this.loading = true;

      let formData = {
        ...this.formData,
      };
      formData = {
        ...formData,
        fields: JSON.stringify(formData.fields),
      };
      fetch(this.action_url, {
        method: "POST",
        headers: {
          "Content-type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(formData),
      })
        .then((res) => res.json())
        .then((res) => {
          if (res.success) {
            let domHTML = ref.querySelector(".dom-html");
            domHTML.innerHTML = res.html;
            window.lazyLoadInstance.update();
          }
          this.loading = false;
        })
        .catch((err) => {
          console.error(err);
          alert(err);
          this.loading = false;
        });
    },
  }));
};

export default loadPosts;
