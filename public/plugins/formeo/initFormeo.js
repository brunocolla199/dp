'use strict';

function initFormeo(formData, basePath){
    console.log(basePath);
    
    formData = (formData) || null;
    
    let container = document.querySelector('.build-form');
    let renderContainer = document.querySelector('.render-form');
    let formeoOpts = {
        container: container,
        i18n: {
            locale: 'pt-BR',
            location: basePath+'/plugins/formeo/lang/',
            
        },
    // allowEdit: false,
    controls: {
        sortable: false,
        groupOrder: [
        'common',
        'html',
        ],
        elements: [
    //     {
    //   tag: 'input',
    //   attrs: {
    //     type: 'radio',
    //     required: false
    //   },
    //   config: {
    //     label: 'Radio Group',
    //     disabledAttrs: ['type']
    //   },
    //   meta: {
    //     group: 'common',
    //     icon: 'radio-group',
    //     id: 'radio'
    //   },
    //   options: (() => {
    //     let options = [1, 2, 3].map(i => {
    //       return {
    //         label: 'Radio ' + i,
    //         value: 'radio-' + i,
    //         selected: false
    //       };
    //     });
    //     let otherOption = {
    //         label: 'Other',
    //         value: 'other',
    //         selected: false
    //       };
    //     options.push(otherOption);
    //     return options;
    //   })(),
    //   action: {
    //     mouseover: evt => {
    //       console.log(evt);
    //       const {target} = evt;
    //       if (target.value === 'other') {
    //         const otherInput = target.cloneNode(true);
    //         otherInput.type = 'text';
    //         target.parentElement.appendChild(otherInput);
    //       }
    //     }
    //   }
    // },

        ],
        elementOrder: {
        common: [
        'button',
        'checkbox',
        'date-input',
        'hidden',
        'number',
        'radio',
        'select',
        'text-input',
        'textarea',
        ]
        }
    },
    events: {
        // onUpdate: console.log,
        // onSave: console.log
    },
    svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
    // debug: true,
    sessionStorage: true,
    editPanelOrder: ['attrs', 'options']
    };


    if(formData !== null){
        const formeo = new window.Formeo(formeoOpts, formData);
    } else {
        const formeo = new window.Formeo(formeoOpts);
    }

    let editing = true;

    let toggleEdit = document.getElementById('renderForm');
    let viewDataBtn = document.getElementById('viewData');
    let resetDemo = document.getElementById('reloadBtn');

    // resetDemo.onclick = function() {
    //     window.sessionStorage.removeItem('formData');
    //     location.reload();
    // };

    toggleEdit.onclick = evt => {

       formeo.render(renderContainer);
            
    };

    // viewDataBtn.onclick = evt => {
    // console.log(formeo.formData);
    // };


}