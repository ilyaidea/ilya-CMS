module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'public/assets/datatables-responsive/css/responsive.dataTables.min.css':
                        'public/assets/datatables-responsive/css/responsive.dataTables.scss'
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.registerTask('default', [
        'sass'
    ]);
};