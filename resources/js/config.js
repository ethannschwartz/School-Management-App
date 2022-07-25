export default {
    layout: {
        exclude: [
            'Auth/Login',
            'Auth/Register',
            'Auth/ResetPassword',
            'FileViewer',
            'Students/TeacherProfile',
            'Branding',
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
                route: 'profile.show',
            },
            {
                title: 'Settings',
                route: 'settings.index',
            },
        ],
        studentLinks: [
            {
                title: 'Courses',
                route: 'courses.index',
            },
            {
                title: 'Settings',
                route: 'settings.index',
            },
        ],
    },
    settings: [
        {
            title: 'Profile',
            svg: 'icon-profile',
        },
        {
            title: 'Payment Method',
            svg: 'icon-credit-card',
        },
        {
            title: 'Subscriptions',
            svg: 'icon-bookmark-collection',
        },
        {
            title: 'Privacy Settings',
            svg: 'icon-security-shield',
        },
    ],
    schools: [
        'University of Washington, Seattle',
        'University of Vermont',
        'Eastern Gateway Community College',
        'Austin Community College',
        'Santa Monica College',
        'University of Rhode Island',
        'University of Arizona',
    ],
};
