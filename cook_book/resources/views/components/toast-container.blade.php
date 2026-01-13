<div x-data="toastContainer()" x-init="init()" class="fixed top-20 right-4 z-50 space-y-3" style="max-width: 400px;">
    <template x-for="(toast, index) in toasts" :key="index">
        <div
            x-show="toast.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-full"
            x-transition:enter-end="opacity-100 transform translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-full"
            class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden"
            style="min-width: 300px;"
        >
            <div class="p-4 flex items-start gap-3" :class="{
                'bg-gradient-to-r from-green-50 to-emerald-50 border-l-4': toast.type === 'success',
                'bg-gradient-to-r from-red-50 to-rose-50 border-l-4': toast.type === 'error',
                'bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4': toast.type === 'info',
                'bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4': toast.type === 'warning',
                'border-green-400': toast.type === 'success',
                'border-red-400': toast.type === 'error',
                'border-blue-400': toast.type === 'info',
                'border-yellow-400': toast.type === 'warning'
            }">
                <!-- Icône -->
                <div class="flex-shrink-0">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" style="color: #10b981;">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" style="color: #ef4444;">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" style="color: #3b82f6;">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" style="color: #f59e0b;">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </template>
                </div>
                
                <!-- Message -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" :class="{
                        'text-green-800': toast.type === 'success',
                        'text-red-800': toast.type === 'error',
                        'text-blue-800': toast.type === 'info',
                        'text-yellow-800': toast.type === 'warning'
                    }" x-text="toast.message"></p>
                </div>
                
                <!-- Bouton fermer -->
                <button
                    @click="removeToast(index)"
                    class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>

@once
<script>
if (typeof window.toastContainerInstance === 'undefined') {
    window.toastContainerInstance = null;
    window.toastGlobalToasts = [];
    
    function toastContainer() {
        return {
            toasts: window.toastGlobalToasts,
            
            init() {
                // Si une instance existe déjà, ne pas réinitialiser
                if (window.toastContainerInstance) {
                    return;
                }
                
                window.toastContainerInstance = this;
                
                // Écouter les événements de toast depuis le backend
                @if(session('success'))
                    this.showToast({!! json_encode(session('success')) !!}, 'success');
                @endif
                
                @if(session('error'))
                    this.showToast({!! json_encode(session('error')) !!}, 'error');
                @endif
                
                @if(session('status') && session('status') !== 'verification-link-sent' && session('status') !== 'profile-updated' && session('status') !== 'password-updated')
                    this.showToast({!! json_encode(session('status')) !!}, 'info');
                @endif
                
                @if(session('status') === 'profile-updated')
                    this.showToast('Profil mis à jour avec succès', 'success');
                @endif
                
                @if(session('status') === 'password-updated')
                    this.showToast('Mot de passe mis à jour avec succès', 'success');
                @endif
                
                // Écouter les événements personnalisés (une seule fois)
                if (!window.toastEventListenerAdded) {
                    window.addEventListener('toast', (e) => {
                        if (window.toastContainerInstance) {
                            window.toastContainerInstance.showToast(e.detail.message, e.detail.type || 'success');
                        }
                    });
                    window.toastEventListenerAdded = true;
                }
            },
            
            showToast(message, type = 'success') {
                // Vérifier si le toast n'existe pas déjà
                const exists = this.toasts.some(t => t.message === message && t.type === type && t.show);
                if (exists) {
                    return;
                }
                
                const toast = {
                    message: message,
                    type: type,
                    show: true,
                    id: Date.now() + Math.random()
                };
                
                this.toasts.push(toast);
                
                // Auto-suppression après 5 secondes
                setTimeout(() => {
                    const index = this.toasts.findIndex(t => t.id === toast.id);
                    if (index >= 0) {
                        this.removeToast(index);
                    }
                }, 5000);
            },
            
            removeToast(index) {
                if (index >= 0 && index < this.toasts.length) {
                    this.toasts[index].show = false;
                    setTimeout(() => {
                        this.toasts.splice(index, 1);
                    }, 200);
                }
            }
        }
    }
    
    // Fonction globale pour afficher des toasts depuis JavaScript
    window.showToast = function(message, type = 'success') {
        window.dispatchEvent(new CustomEvent('toast', {
            detail: { message, type }
        }));
    };
}
</script>
@endonce
