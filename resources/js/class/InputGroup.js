export default class InputGroup {
    static events = {
        init() {
            InputGroup.events.dom();
        },
        dom() {
            $(document).on('click', '.group-input.password > div', InputGroup.passwordToggle);
        }
    }

    static passwordToggle() {
        if($(this).closest('.group-input').find('input').attr('type') === 'password') {
            $(this).closest('.group-input').find('input').attr('type', 'text');
            $(this).text('🙊');
        } else {
            $(this).closest('.group-input').find('input').attr('type', 'password');
            $(this).text('🙈');
        }
    }


}

