// get element
const getElement = function(selector, callback = null){

    // make query
    const element = typeof selector !== 'string' ? selector : this.querySelector(selector);

    // load callback
    if (callback !== null && element !== null) callback.call(this, element);

    // return element
    return element;
};

// get all elements
const getAllElements = function(identifier, callback = null){

    // find element
    const elements = Array.prototype.map.call(this.querySelectorAll(identifier), (e)=>{ return e; });

    // call callback
    if (elements.length > 0 && callback !== null) callback.call(this, elements);

    // return element
    return elements;
};

// let's define how we want to use querySelector
Document.prototype.get = Element.prototype.get = getElement;

// let's define how we want to use queryAllSelector
Document.prototype.getAll = Element.prototype.getAll = getAllElements;

// show modal for element
Element.prototype.showModal = function () {
    this.classList.remove('animate-modal-out');
    this.classList.add('animate-modal');
};

// hide modal for element
Element.prototype.hideModal = function (callback=null) {
    this.classList.add('animate-modal-out');
    setTimeout(()=>{
        this.classList.remove('animate-modal');
        if (callback !== null) callback.call(this);
    },600);
};

// logs
const logs = {

    // page did load
    init : ()=> {
        console.info('Welcome to AutoFixer, Designed and Engineered by FregateLab Inc.');

        // switch password type for forms
        switchPasswordType();
    },

    // all good
    loaded : () => {
        console.info('Everything looks good. Please enjoy your browsing experience.');
    },

    // support
    support : () => {
        console.info('Please send an email to [support@fregatelab.com] if you experence any difficulty using the web app. Yours truly!');
    }
};

// just init log
logs.init();

// get content before
let contentBefore = '';

// load buttons
const buttons = {

    // loading button
    loading : function(target, content = '')
    {
        // cache button
        let buttonReference = null;

        // show loader now
        document.get(target, (button)=>{

            // cache content before
            contentBefore = button.innerHTML;

            // disable button
            button.setAttribute('disabled', 'yes');

            // set ref
            buttonReference = button;

            // load loader
            button.innerHTML = '<span class="inline-loader-text"><span data-spinner="text">'+content+'</span> <div class="spinner-border text-light spinner-button loader"></div></span>';
        });

        // return function
        return {
            hide : function(delay = 0){

                if (buttonReference !== null)
                {
                    // return back to base
                    setTimeout(()=>{
                        buttonReference.innerHTML = this.content;
                        buttonReference.removeAttribute('disabled');

                        // load resolve
                        //resolve(buttonReference);

                    }, delay);
                }
            },

            // change text content
            text : function(content, delay=0)
            {
                const promise = new Promise((resolve, reject) => {
                    if (buttonReference !== null)
                    {
                        setTimeout(()=>{
                            buttonReference.get('*[data-spinner="text"]', (spinnerText)=>{
                                spinnerText.innerHTML = content;
                                // load resolve
                                resolve(buttonReference);
                            });
                        }, delay);
                    }
                    else
                    {
                        reject('Could not proceed.');
                    }
                });

                // return promise
                return promise;
            },

            // cache content
            content : contentBefore
        }
    },

    // success button
    success : function(target, content, delay = 3000)
    {
        const promise = new Promise((resolve, reject)=>{

            // show success button now
            document.get(target, (button)=>{

                setTimeout(()=>{

                    // cache content before
                    contentBefore = contentBefore == '' ? button.innerHTML : contentBefore;

                    // load text
                    button.innerHTML = content;

                    // change class
                    button.classList.add('btn-success-theme');

                    // disable button
                    button.setAttribute('disabled','true');

                    // resolve
                    resolve({status:1, btn: button});

                    // remove
                    setTimeout(()=>{

                        // remove disabled button
                        button.removeAttribute('disabled');
                        button.classList.remove('btn-success-theme');
                        button.innerHTML = contentBefore;

                        // reset content before
                        contentBefore = '';

                        // resolve
                        resolve({status:2, btn: button});

                    }, delay);

                }, 0);

            });

        });

        // return promise
        return promise;
    },

    // error button
    error : function(target, content, delay = 3000)
    {
        const promise = new Promise((resolve, reject)=>{

            // show success button now
            document.get(target, (button)=>{

                setTimeout(()=>{

                    // cache content before
                    contentBefore = contentBefore == '' ? button.innerHTML : contentBefore;

                    // load text
                    button.innerHTML = content;

                    // change class
                    button.classList.add('btn-danger-theme');

                    // all good
                    resolve({status:1, btn: button});

                    // disable button
                    button.setAttribute('disabled','true');

                    // remove
                    setTimeout(()=>{

                        // remove disabled button
                        button.removeAttribute('disabled');
                        button.classList.remove('btn-danger-theme');
                        button.innerHTML = contentBefore;

                        // reset content before
                        contentBefore = '';

                        // all good
                        resolve({status:2, btn: button});

                    }, delay);

                }, 0);

            });

        });

        // return promise
        return promise;
    }
}

// switch password types
function switchPasswordType()
{
    document.getAll('.control-password', (switcherArray)=>{

        // loop through
        switcherArray.forEach((element)=>{

            // listen for click events
            element.addEventListener('click', ()=>{
                if (element.firstElementChild.hasAttribute('data-changed'))
                {
                    element.firstElementChild.removeAttribute('data-changed');
                    element.firstElementChild.className = element.getAttribute('data-default');

                    // change type to password
                    element.parentNode.get('input', (e)=>{e.type = 'password';});
                }
                else
                {
                    element.firstElementChild.setAttribute('data-changed', 'yes');
                    element.firstElementChild.className = element.getAttribute('data-changed');

                    // change type to text
                    element.parentNode.get('input', (e)=>{e.type = 'text';});
                }
            });

        });
    });
}

// events
const events = {
    roles : {
        uncheckAll : function(action = null){

            // helper function
            const helper = function(target, element, checked = false)
            {
                if (action === true) {
                    if (!element.hasAttribute('data-clicked')) element.setAttribute('data-clicked','yes');
                    element.click();
                }

                // clicked
                element.addEventListener('click', ()=>{

                    // manage toggle
                    if (element.hasAttribute('data-clicked')) {
                        checked = true;
                        element.textContent = 'Uncheck all';
                        if (element.hasAttribute('data-clicked')) element.removeAttribute('data-clicked');
                    }
                    else
                    {
                        element.setAttribute('data-clicked', 'yes');
                        element.textContent = 'Check all';
                        checked = false;
                    }

                    // look for data-access=read
                    document.getAll('*[data-access="'+target+'"]', function(elements){
                        elements.forEach(input => { input.checked = checked; });
                    });
                });
            };

            // look for read button
            document.get('#uncheck-all-read', function(element){
                // load helper
                helper('read', element, false);
            });

            // look for write button
            document.get('#uncheck-all-write', function(element){
                // load helper
                helper('write', element, false);
            });
        },

        matchAccess : function(){

            // look for data attr
            document.getAll('*[data-access]', function(elements){
                // load all
                elements.forEach(element => {

                    // listen for change event
                    element.addEventListener('change', ()=>{

                        // change children also
                        changeChildWithDataParent(element);
                    });
                });
            });

            // change child
            function changeChildWithDataParent(element)
            {
                // load all children
                document.getAll('*[data-parent="'+element.id+'"]', function(children){

                    // load all
                    children.forEach(child => {
                        child.checked = element.checked;
                    });
                });
            }
        },

        loadRef : function()
        {
            // @var array refArray
            let refArray = [], refKeys = [];

            // Run query
            document.getAll('*[data-ref]', function(elements){

                // loop through
                elements.forEach((element) => {

                    // create object
                    let objectWrapper = Object.create(null);
                    objectWrapper.NavRef = element.getAttribute('data-ref');

                    // can save
                    let canSave = true;

                    // check refKeys
                    if (refKeys.indexOf(objectWrapper.NavRef) >= 0) {
                        objectWrapper = refArray[refKeys.indexOf(objectWrapper.NavRef)];
                        canSave = false;
                    }
                    else
                    {
                        refKeys.push(objectWrapper.NavRef);
                    }

                    // check access
                    switch (element.getAttribute('data-access'))
                    {
                        // read
                        case 'read':
                            objectWrapper.read = element.checked == true ? 1 : 0;
                            break;

                        // write
                        case 'write':
                            objectWrapper.write = element.checked == true ? 1 : 0;
                            break;
                    }

                    // push object
                    if (canSave) refArray.push(objectWrapper);

                });
            });

            // return array
            return refArray;
        }
    }
};

// preloader
const preloader = {
    inline : {
        cache : {},
        target : null,
        show : function(target){

            let object = function(){};

            // get element
            document.get(target, (e)=>{

                // cache body
                object.target = e;

                // set preloader
                e.setAttribute('data-preloader-inline', 'yes');

                // can we cache the body?
                if (typeof this.cache[target] == 'undefined')
                {
                    this.cache[target] = e.innerHTML;
                }

                object.cache = this.cache[target];

                // reset
                e.innerHTML = '<div class="preloader-line"></div>\
                <div class="preloader-line"></div>\
                <div class="preloader-line"></div>';

                // show element
                if (e.hasAttribute('data-preloader-inline')) e.removeAttribute('data-preloader-inline');
            });

            // bind others
            object.constructor = this.constructor;
            object.error = this.error;
            object.hide = this.hide;

            // return instance
            return object;
        },
        hide : function(){
            if (this.target != null) this.target.innerHTML = this.cache;
        },
        error : function(errorText){
            if (this.target != null) this.target.innerHTML = '<div class="error-screen">\
            <span class="error-icon"></span>\
            <span class="error-text">'+errorText+'</span></div>';
        }
    }
}

// modal
const modal = {
    show : function(title, message, type = 'error')
    {
        document.get('*[data-target="modal-message"]', (modalContainer)=>{

            // remove style
            modalContainer.removeAttribute('style');

            // Add it's titel
            modalContainer.querySelector('h2').innerText = title;

            // add it's message
            modalContainer.querySelector('p').innerText = message;

            // update modal-icon
            modalContainer.querySelector('*[data-modal="'+type+'"]').style.display = 'block';

            // show modal
            modalContainer.classList.add('show');

            // toggle modal
            toggleModalMessage(modalContainer);

        });
    }
};

// show loader
document.getAll('*[data-show-loader]', (elements)=>{
    elements.forEach((element)=>{
        // get the parent
        let form = document.forms[element.getAttribute('data-show-loader')];
        form.addEventListener('submit', ()=>{
            let clean = 0;

            var loader = buttons.loading(element);

            setTimeout(()=>{

                let children = form.querySelectorAll('input,select,textarea');

                [].forEach.call(children, (child)=>{
                    if (child.classList.contains('is-invalid')) clean += 1;
                });

                if (clean > 0) loader.hide();

            }, 500);
        });
    });
});