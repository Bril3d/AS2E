import { watch } from 'vue';
import { useToast } from 'vue-toastification';
import { usePage } from '@inertiajs/vue3';


export function toastCall() {
  const toast = useToast()

  watch(() => usePage().props?.flash, flash => {

    if (flash?.message) {
      toast(flash.message)
    }
    if (flash?.success) {
      toast.success(flash.success)
    }
    if (flash?.error) {
      toast.error(flash.error)
    }

  }, { deep: true })
}
