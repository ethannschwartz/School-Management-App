<template>
    <component
        :is="name"
        class="inline-block"
    />
</template>

<script>
// Icon source is Google Material: https://fonts.google.com/icons

import ClosingX from './SvgPaths/ClosingX'
import ChevronLeft from './SvgPaths/ChevronLeft'
import ChevronRight from './SvgPaths/ChevronRight'
import ClipboardCopy from './SvgPaths/ClipboardCopy'
import Check from './SvgPaths/Check'
import Share from './SvgPaths/Share'
import PlusSign from './SvgPaths/PlusSign'
import Download from './SvgPaths/Download'
import Profile from './SvgPaths/Profile'

export default {
    name: 'base-svg',
    components: {
        'icon-closing-x': ClosingX,
        'icon-chevron-left': ChevronLeft,
        'icon-chevron-right': ChevronRight,
        'icon-clipboard-copy': ClipboardCopy,
        'icon-check': Check,
        'icon-share': Share,
        'icon-plus-sign': PlusSign,
        'icon-download': Download,
        'icon-profile': Profile,
    },
    props: {
        name: {
            type: String,
            required: true,
        }
    }
}
</script>
