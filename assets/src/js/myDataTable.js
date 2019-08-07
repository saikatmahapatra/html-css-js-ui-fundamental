/*
@ Developer: Saikat Mahapatra <https://in.linkedin.com/in/saikatmahapatra>
@ Repo: https://github.com/saikatmahapatra/sample-web-app-for-poc
*/

$(document).ready(initDOM);

function initDOM() {
    var table;
    // Render DataTable
    //table = renderDataTable();

    // Search by value
    /*$('.filter-by').on('change',function(){
    	table.draw();		
    });*/

    $('#btn_submit').on('click', function(e) {
        e.preventDefault();
        if (table) {
            table.draw();
        } else {
            table = renderDataTable();
        }

    });
}

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var application = $('#application').val().toLowerCase();
        var applicationData = data[0].toLowerCase(); // use data for the application column		
        if (application != "") {
            if (applicationData == application) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
);

$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var environment = $('#environment').val().toLowerCase();
        var environmentData = data[5].toLowerCase(); // use data for the environment column			
        if (environment != "") {
            if (environmentData == environment) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
);

$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var country = $('#country').val().toLowerCase();
        var countryData = data[6].toLowerCase(); // use data for the country column
        if (country != "") {
            if (countryData == country) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
);

$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var action = $('#action').val().toLowerCase();
        var actionData = data[7].toLowerCase(); // use data for the action column		
        if (action != "") {
            if (actionData == action) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }
);


function renderDataTable() {
    table = $('#frameworkDataTable').DataTable({
        'ajax': {
            'url': 'assets/mock_data/response.json',
            'dataSrc': function(json) {
                console.log(json);
                var return_data = new Array();
                $.each(json.applications, function(index, appObj) {
                    //console.log(index);					
                    $.each(appObj.commands, function(cmdIndex, cmdObj) {
                        //console.log(cmdObj.deploymentPlan);
                        return_data.push({
                            'application': appObj.application,
                            'build': appObj.build,
                            'templateCategory': appObj.templateCategory,
                            'deploymentPlanType': appObj.deploymentPlanType,
                            'deploymentTemplate': appObj.deploymentTemplate,
                            'svn_manifests_path': appObj.svn_manifests_path,
                            'svn_app_manifest_path': appObj.svn_app_manifest_path,
                            'dependent_patch': appObj.dependent_patch,
                            'deploymentId': cmdObj.deploymentId,
                            'deploymentPlan': cmdObj.deploymentPlan,
                            'deployment': cmdObj.deployment,
                            'action': '<label class="radio-inline"><input type="radio" value=""> ' + cmdObj.action + '</label>',
                            'env': cmdObj.env,
                            'project': cmdObj.project,
                            'svn_rel_manifest_path': cmdObj.svn_rel_manifest_path,
                        });
                    });
                });
                return return_data;

            },
        },
        'columns': [
            { 'data': "application" },
            { 'data': "build" },
            { 'data': "templateCategory" },
            { 'data': "deploymentPlanType" },
            { 'data': "deployment" },
            { 'data': "env" },
            { 'data': "project" },
            { 'data': "action" },
        ]
    });
    return table;
}