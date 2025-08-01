<script setup lang="ts">
import StreamingIndicator from './StreamingIndicator.vue';
import { useStream } from '@laravel/stream-vue';
import { onMounted, onUnmounted, ref, watch } from 'vue';
type Message = {
    type: 'response' | 'error' | 'prompt';
    content: string;
};
const messages = ref<Message[]>([]);
const { data, send, cancel, isStreaming, id } = useStream('chat');
const handleEscape = (e: KeyboardEvent) => {
    if (e.key === 'Escape') {
        cancel();
    }
};
onMounted(() => {
    window.addEventListener('keydown', handleEscape);
});
onUnmounted(() => {
    window.removeEventListener('keydown', handleEscape);
});
watch([isStreaming, data], () => {
    if (isStreaming.value) {
        window.scrollTo(0, document.body.scrollHeight);
    }
});
const submit = (e: Event) => {
    e.preventDefault();
    const form = e.target as HTMLFormElement;
    const input = form.querySelector('input') as HTMLInputElement;
    const query = input?.value;
    const toAdd: Message[] = [];
    if (data.value) {
        toAdd.push({
            type: 'response',
            content: data.value,
        });
    }
    if (query) {
        toAdd.push({
            type: 'prompt',
            content: query,
        });
    }
    messages.value = [...messages.value, ...toAdd];
    send({ messages: [...messages.value, ...toAdd] });
    input.value = '';
};
</script>

<template>
    <div class="flex min-h-screen flex-col bg-white">
        <div class="mx-auto w-full max-w-4xl flex-1 px-6 py-8">
            <div class="mb-24 space-y-6">
                <div v-if="messages.length === 0" class="py-12 text-center">
                    <div class="text-lg text-gray-400">How can I help you today?</div>
                </div>

                <div v-for="(message, index) in messages" :key="index" class="space-y-4">
                    <div v-if="message.type === 'prompt'" class="flex justify-end">
                        <div class="max-w-xs rounded-2xl bg-blue-500 px-4 py-3 text-white sm:max-w-md lg:max-w-lg">
                            <span v-html="message.content.replace(/\n/g, '<br>')" />
                        </div>
                    </div>

                    <div v-if="message.type === 'response'" class="flex justify-start">
                        <div class="max-w-xs rounded-2xl bg-gray-100 px-4 py-3 text-gray-900 sm:max-w-md lg:max-w-2xl">
                            <span v-html="message.content.replace(/\n/g, '<br>')" />
                        </div>
                    </div>
                </div>

                <div v-if="data" class="flex justify-start">
                    <div class="relative max-w-xs rounded-2xl bg-gray-100 px-4 py-3 text-gray-900 sm:max-w-md lg:max-w-2xl">
                        <span v-html="data.replace(/\n/g, '<br>')" />
                        <StreamingIndicator :id="id" class="ml-2 inline-block" />
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed right-0 bottom-0 left-0 border-t border-gray-200 bg-white px-6 py-4">
            <div class="mx-auto max-w-4xl">
                <form class="flex gap-3" @submit="submit">
                    <input
                        type="text"
                        placeholder="Type your message..."
                        class="flex-1 rounded-2xl border border-gray-300 bg-white px-4 py-3 text-gray-900 focus:border-transparent focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    />
                    <button
                        type="submit"
                        class="rounded-2xl bg-blue-500 px-6 py-3 font-medium text-white transition-colors hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    >
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
