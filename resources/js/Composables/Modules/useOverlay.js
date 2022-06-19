import {ref, computed} from "vue";

const visibility = ref(false);
const visible = computed(()=>!(visibility.value === false));
const zindex = computed(()=>visibility.value);

export default function useOverlay() {

    const setVisibility = (value)=>{
        visibility.value = value;
    };

    return {
        visible,
        zindex,
        setVisibility,
    };

};
