<?php 
  $action = 'contact_form';
  $action_url = admin_url('admin-ajax.php');
  $referer = wp_get_referer();
  $nonce = wp_create_nonce($action);
?>

<form 
  x-data="contactForm($refs.formRef)"
  x-ref="formRef"
  @submit.prevent="submit"
  data-action="<?php echo $action; ?>"
  data-action-url="<?php echo $action_url; ?>"
  data-referer="<?php echo $referer; ?>"
  data-nonce="<?php echo $nonce; ?>"
  novalidate
  class="space-y-6"
>
  <div>
    <input 
      type="text" 
      x-model="formData.fields.full_name.value"
      @keyup="firstSubmit && formData.fields.full_name.validate(validateCallback)"
      required
      placeholder="Full name *"
      :disabled="loading"
      class="w-full p-3 border"
      :class="formData.fields.full_name.message ? 'border-red-500' : 'border-black'"
    />
    <p x-show="formData.fields.full_name.message" x-cloak x-text="formData.fields.full_name.message" class="text-red-500 text-sm"></p>
  </div>
  <div>
    <input 
      type="text" 
      x-model="formData.fields.telephone.value"
      @keyup="firstSubmit && formData.fields.telephone.validate(validateCallback)"
      required
      placeholder="Telephone *"
      :disabled="loading"
      x-mask="9999999999"
      class="w-full p-3 border"
      :class="formData.fields.telephone.message ? 'border-red-500' : 'border-black'"
    />
    <p x-show="formData.fields.telephone.message" x-cloak x-text="formData.fields.telephone.message" class="text-red-500 text-sm"></p>
  </div>
  <div>
    <input 
      type="email" 
      <?php /*
      pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
      */ ?>
      x-model="formData.fields.email.value"
      @keyup="firstSubmit && formData.fields.email.validate(validateCallback)"
      placeholder="E-mail *"
      :disabled="loading"
      class="w-full p-3 border"
      :class="formData.fields.email.message ? 'border-red-500' : 'border-black'"
    />
    <p x-show="formData.fields.email.message" x-cloak x-text="formData.fields.email.message" class="text-red-500 text-sm"></p>
  </div>
  <div>
    <button 
      type="submit"
      :disabled="loading"
      class="px-3 py-1.5 bg-black text-white"
      :class="loading ? 'cursor-not-allowed opacity-50' : ''"
    >
      Submit
    </button>
  </div>
</form>
