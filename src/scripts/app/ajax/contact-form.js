import { Iodine } from "@kingshott/iodine";

const contactForm = () => {
  window.Alpine.data("contactForm", (ref) => ({
    action_url: ref.getAttribute("data-action-url"),
    formData: {
      action: ref.getAttribute("data-action"),
      nonce: ref.getAttribute("data-nonce"),
      referer: ref.getAttribute("data-referer"),
      fields: {
        full_name: {
          value: null,
          defaultValue: null,
          rules: ["required"],
          valid: null,
          message: null,
          validate(callback) {
            let { valid, message } = callback(this);
            this.valid = valid;
            this.message = message;
          },
        },
        telephone: {
          value: null,
          defaultValue: null,
          rules: ["required"],
          valid: null,
          message: null,
          validate(callback) {
            let { valid, message } = callback(this);
            this.valid = valid;
            this.message = message;
          },
        },
        email: {
          value: null,
          defaultValue: null,
          rules: ["required", "email"],
          valid: null,
          message: null,
          validate(callback) {
            let { valid, message } = callback(this);
            this.valid = valid;
            this.message = message;
          },
        },
      },
    },
    firstSubmit: false,
    loading: false,
    formValid: true,
    validateCallback(field) {
      const iodine = new Iodine();
      let { value, rules } = field;
      let valid = iodine.isValid(value, rules);
      let message = valid
        ? null
        : iodine.getErrorMessage(iodine.is(value, rules));
      return { valid, message };
    },
    validateForm(fields) {
      Object.keys(fields).map((fieldName) => {
        this.formData.fields[fieldName].validate(this.validateCallback);
      });
      return !Object.values(fields).some((field) => !field.valid);
    },
    resetForm(fields) {
      ref.reset();
      this.firstSubmit = false;
      Object.keys(fields).map((fieldName) => {
        let field = this.formData.fields[fieldName];
        this.formData.fields[fieldName] = {
          ...field,
          value: field.defaultValue,
          valid: null,
          message: null,
        };
      });
    },
    submit() {
      if (!this.firstSubmit) {
        this.firstSubmit = true;
      }

      this.loading = true;

      this.formValid = this.validateForm(this.formData.fields);

      if (this.formValid) {
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
              this.resetForm(this.formData.fields);
            }
            alert(`${res.alert.name} - ${res.alert.message}`);
            this.loading = false;
          })
          .catch((err) => {
            console.error(err);
            alert(err);
            this.loading = false;
          });
      } else {
        this.loading = false;
      }
    },
  }));
};

export default contactForm;
