import Library from './Library';
import Settings from './Settings';

const Controllers = {
    Library: Object.assign(Library, Library),
    Settings: Object.assign(Settings, Settings),
};

export default Controllers;
