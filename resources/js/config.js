export default {
    layout:{
        exclude: [
            'Auth/Login',
            'Auth/Register',
            'Auth/ResetPassword',
            'FileViewer',
        ],
    },
    dialogs: {
        modals: {
            zindex: 40,
        },
    },
    nav: {
        teacherLinks: [
            {
                title: 'Courses',
                route: 'courses.index',
            },
            {
                title: 'Subscriptions',
                route: 'subscriptions.index',
            },
        ],
        studentLinks: [
            {
                title: 'Teachers',
                route: 'teachers.index',
            },
            {
                title: 'Courses',
                route: 'courses.index',
            },
        ],
    },
};
