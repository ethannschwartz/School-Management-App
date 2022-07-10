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
                title: 'Subscribers',
                route: 'subscribers.index',
            },
            {
                title: 'Profile',
                route: 'profile.profile.show',
            },
        ],
        studentLinks: [
            {
                title: 'Courses',
                route: 'courses.index',
            },
        ],
    },
};
