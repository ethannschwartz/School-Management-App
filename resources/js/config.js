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
                title: 'Analytics',
                route: 'analytics.index',
            },
        ],
        studentLinks: [
            {
                title: 'Teachers',
                route: 'users.teachers.index',
            },
            {
                title: 'Courses',
                route: 'courses.index',
            },
        ],
    },
};
