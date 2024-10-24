<script setup>
import {onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    title: {
        type: String,
        default: 'Modal title', // Dynamiczny tytuł modala
    },
    id_position:{
        type:String,
    }
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    (newVal) => {
        if (newVal) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    },
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => {
    document.addEventListener('keydown', closeOnEscape);
});

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});
</script>

<template>
    <Teleport to="body">
        <div v-if="show" class="modal fade show d-block" tabindex="-1" style="display: block;" @click="close">
            <div class="modal-dialog" @click.stop>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ title }}</h5>
                        <button type="button" class="btn-close" @click="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <slot/>
                        {{ id_position }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="close">Potwierdź</button>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>
