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
            {
                title: 'Profile',
                route: 'teachers.profile.show',
            },
        ],
        studentLinks: [
            {
                title: 'Courses',
                route: 'courses.index',
            },
            {
                title: 'Teachers',
                route: 'teachers.index',
            },
        ],
    },
};
