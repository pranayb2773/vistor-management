import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import mask from '@alpinejs/mask';
import dayjs from 'dayjs/esm';
import customParseFormat from 'dayjs/plugin/customParseFormat';

Alpine.plugin(focus);
Alpine.plugin(mask);

dayjs.extend(customParseFormat);

window.Alpine = Alpine;
window.dayjs = dayjs;
Alpine.start();
