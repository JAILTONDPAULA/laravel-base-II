class Page {
    static events = {
        init() {
            Page.events.dom();
            Preload.hide();
        },
        dom() {

        }
    }
}

$(document).ready(Page.events.init);
