import config from "@/config";
import useDialog from "./useDialog";
import {ModalTransition} from "@/Components";

const { toggleDialog } = useDialog();

export default function useModalDialog(){

    const toggleModal = (modal, event, data) => {
        toggleDialog(modal, ModalTransition, data, event, config.dialogs.modals.zindex, true);
    };

    return {
        toggleModal,
    };

};
