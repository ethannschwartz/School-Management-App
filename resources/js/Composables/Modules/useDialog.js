import {ref, computed, markRaw} from "vue";
import useOverlay from "./useOverlay";

const dialog = ref(false);
const wrap = ref(false);
const trigger = ref(false);
const visibility = ref(false);
const data = ref(false);
const registered = ref(false);


const { setVisibility: setOverlayVisibility } = useOverlay();

export default function useDialog(){

    const clearTrigger = () => {
        trigger.value = false;
    };

    const forceClose = (clear = false) => {
        visibility.value = false;
        data.value = false;
        setOverlayVisibility(false);
        if(clear){
            clearTrigger();
        }
    };

    const forceOpen = (component, transition, componentData, event, zindex, overlay) => {
        visibility.value = zindex;
        data.value = componentData;
        dialog.value = component ? markRaw(component) : false;
        wrap.value = transition ? markRaw(transition) : false;
        trigger.value = event.target ?? false;
        setOverlayVisibility(overlay ? (zindex - 10) : false);
    };

    const toggleDialog = (component, transition, componentData, event, zindex, overlay) => {
        //if not visible, automatically open
        if(!visibility.value){
            forceOpen(component, transition, componentData, event, zindex, overlay);
            return;
        }

        //if the trigger matches previous trigger, close
        if(trigger.value === event.target){
            forceClose();
            return
        }

        if(component.__file === dialog.value.__file){
            if(componentData === data.value){
                forceClose();
                return
            }
        }

        forceOpen(component, transition, componentData, event, zindex, overlay);
    };

    function mount(){
        if(!registered.value){
            document.addEventListener('click',(event)=>{
                if(!event.target.closest('[data-dialog="true"]')){
                    try {
                        forceClose(1);
                    }catch(error){
                        $log.warn(error);
                    }
                }
            }, {passive: true});

            document.addEventListener('keyup',(event) => {
                if(event.key === "Escape") {
                    try {
                        forceClose(1);
                    }catch(error){
                        $log.warn(error);
                    }
                }
            }, {passive: true});
        }
    }

    return {
        mount,
        clearTrigger,
        toggleDialog,
        forceClose,
        dialog,
        wrap,
        trigger: computed(()=>(trigger.value)),
        visible:computed(()=>!(visibility.value === false)),
        zindex: computed(()=>(visibility.value ? visibility.value : 10)),
        data: computed(()=>(data.value)),
    };
};
