function fnToAddAdmin() {
    var isValidated = jQuery('#addNewAdmin').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "admins/fnToAddAdminProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').show();
                $('.cms-bgloader').show();
                if (responseText.status == "success" || responseText.status == "alreadyexist") {
                    window.location = strGlobalSiteBasePath + "admins/Users"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addNewAdmin').ajaxSubmit(options);
        return false
    }
}

function fnToUpdateAdmin() {
    var isValidated = jQuery('#editNewAdmin').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "admins/fnToUpdateSubAdmin";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success" || responseText.status == "alreadyexist") {
                    $('.cms-bgloader-mask').show();
                    $('.cms-bgloader').show();
                    window.location = strGlobalSiteBasePath + "admins/Users"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editNewAdmin').ajaxSubmit(options);
        return false
    }
}

function fnToUpdateAdminProfile() {
    var isValidated = jQuery('#frmUpdateProfile').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "admins/fnToUpdateSubAdminProfile";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success" || responseText.status == "alreadyexist") {
                    $('.cms-bgloader-mask').show();
                    $('.cms-bgloader').show();
                    window.location = strGlobalSiteBasePath + "admins/dashboard"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmUpdateProfile').ajaxSubmit(options);
        return false
    }
}

function fnAddCategory() {
    var isValidated = jQuery('#addCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnAddCategory";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').show();
                    $('.cms-bgloader').show();
                    window.location = strGlobalSiteBasePath + "categories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addCategory').ajaxSubmit(options);
        return false
    }
}

function fnUpdateCategory() {
    var isValidated = jQuery('#editCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnCategoryUpdateProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "categories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editCategory').ajaxSubmit(options);
        return false
    }
}

function fnAddSubCategory() {
    var isValidated = jQuery('#addSubCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnAddSubCategories";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "categories/subcategories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addSubCategory').ajaxSubmit(options);
        return false
    }
}

function fnUpdateSubCategory() {
    var isValidated = jQuery('#editSubCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnSubCategoryUpdateProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "categories/subcategories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editSubCategory').ajaxSubmit(options);
        return false
    }
}

function fnAddSubSubCategory() {
    var isValidated = jQuery('#addSubSubCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnAddSubSubCategories";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "categories/subsubcategories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addSubSubCategory').ajaxSubmit(options);
        return false
    }
}

function fnUpdateSubSubCategory() {
    var isValidated = jQuery('#editSubSubCategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "categories/fnEditSubsubcategory";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "categories/subsubcategories"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editSubSubCategory').ajaxSubmit(options);
        return false
    }
}

function fnAddPackage() {
    var isValidated = jQuery('#addPackage').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "packages/fnAddPackage";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "packages"
                } else {}
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addPackage').ajaxSubmit(options);
        return false
    }
}

function fnUpdatePackage() {
    var isValidated = jQuery('#editPackage').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "packages/fnUpdatePackageProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "packages"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editPackage').ajaxSubmit(options);
        return false
    }
}

function ChangeStatus(getcontrol, id, status, model) {
    $.ajax({
        type: "POST",
        url: strGlobalSiteBasePath + "App/UpdateStatus",
        data: {
            "id": id,
            "status": status,
            "model": model
        },
        cache: false,
        dataType: 'json',
        success: function(data) {
            Respstatus = data.status;
            if (Respstatus == "success") {
                switch (model) {
                    case "Category":
                    case "package":
                        window.location = strGlobalSiteBasePath + getcontrol + "/";
                        break;
                    case "Subcategory":
                        window.location = strGlobalSiteBasePath + getcontrol + "/subcategories";
                        break;
                    case "Subsubcategory":
                        window.location = strGlobalSiteBasePath + getcontrol + "/subsubcategories";
                        break;
                    case "Admin":
                        window.location = strGlobalSiteBasePath + getcontrol + "/Users";
                        break;
                    case "User":
                        window.location = strGlobalSiteBasePath + getcontrol + "/websiteusers";
                        break;
                    case "banner":
                        window.location = strGlobalSiteBasePath + getcontrol + "/banner";
                        break;
                    case "MediaComment":
                        window.location = strGlobalSiteBasePath + getcontrol + "/mediacomments";
                        break;
                    case "UserMedia":
                        window.location = strGlobalSiteBasePath + getcontrol + "/usermedia";
                        break;
                    case "Package":
                        window.location = strGlobalSiteBasePath + getcontrol + "/";
                        break
                }
            } else {
                bootbox.alert("Failed");
                return false
            }
        }
    })
}

function fnGetSubcategoryList(categoryid) {
    var intCategory_id = categoryid;
    var datastr = 'category_id=' + intCategory_id;
    var addcover = $('#add_cover').val();
    if (intCategory_id <= 0 && addcover <= 0) {
        $(".fileupload-buttonbar").css('display', 'none');
        alert('Please select category and cover option')
    } else if (intCategory_id > 0 && addcover <= 0) {
        $(".fileupload-buttonbar").css('display', 'none');
        alert('Please select  cover option')
    } else {
        $(".fileupload-buttonbar").css('display', 'block')
    } if (intCategory_id == "") {
        $('#subcatlist').append($("<option></option>"))
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        $.ajax({
            type: "POST",
            url: strGlobalSiteBasePath + "/App/fnToGetAllSubCategoriesList",
            data: {
                category_id: intCategory_id
            },
            dataType: "json",
            cache: false,
            success: function(data) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                var items = [];
                $.each(data, function(key, val) {
                    items.push('<option value="' + key + '">' + val + '</option>')
                });
                $('.subcatlist').html(items)
            },
            error: function() {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide()
            }
        })
    }
}

function fnGetSubSubcategoryList(subcategoryid) {
    var intsubCategory_id = subcategoryid;
    var datastr = 'subcategory_id=' + intsubCategory_id;
    if (intsubCategory_id == "") {
        $('#subsubcatlist').append($("<option></option>"))
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        $.ajax({
            type: "POST",
            url: strGlobalSiteBasePath + "/App/fnToGetAllSubSubCategoryList",
            data: {
                subcategory_id: intsubCategory_id
            },
            dataType: "json",
            cache: false,
            success: function(data) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                var items = [];
                $.each(data, function(key, val) {
                    items.push('<option value="' + key + '">' + val + '</option>')
                });
                $('.subsubcatlist').html(items)
            },
            error: function() {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide()
            }
        })
    }
}
$('.menus li').on('click', function() {
    $('#flashMessage').css("display", "none")
});
$('#updateprofile').on('click', function() {
    var admin_id = $(this).attr('adminid');
    $.ajax({
        type: "POST",
        url: strGlobalSiteBasePath + "/Admins/getSubAdminUpdateData",
        data: {
            "admin_id": admin_id
        },
        cache: false,
        dataType: 'json',
        success: function(data) {
            Respstatus = data.status;
            if (Respstatus == "success") {
                document.frmUpdateProfile.update_admin_id.value = data.admin_id;
                document.frmUpdateProfile.update_admin_fname.value = data.admin_fname;
                document.frmUpdateProfile.update_admin_lname.value = data.admin_lname;
                document.frmUpdateProfile.update_admin_email.value = data.admin_email;
                document.frmUpdateProfile.showcatImage.src = data.admin_image;
                $("#modalUpdateProfile").modal('show')
            } else {
                bootbox.alert("Failed");
                return false
            }
        }
    })
});

function siteArtistRegister() {
    var listdata = $("#category_list").val();
    var selctedarry = new Array();
    var isValidated = jQuery('#frmartistRegister').validationEngine('validate');
    $("#frmartistRegister .dropdown input:checkbox:checked").each(function() {
        selctedarry.push($(this).val())
    });
    if (selctedarry.length <= 0) {
        alert("Please select Category");
        isValidated = false
    }
    if (listdata == null) {
        var alertText = "Please select category";
        $('#category_list').validationEngine('showPrompt', 'Please Select Category', 'load');
        $(".category_listformError").append('<div class="formErrorArrow"><div class="line10"><!-- --></div><div class="line9"><!-- --></div><div class="line8"><!-- --></div><div class="line7"><!-- --></div><div class="line6"><!-- --></div><div class="line5"><!-- --></div><div class="line4"><!-- --></div><div class="line3"><!-- --></div><div class="line2"><!-- --></div><div class="line1"><!-- --></div></div>')
    }
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "Users/fnAddUserProcess/";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success") {
                    $("#modalartistRegister").modal('hide');
                    bootbox.alert("Registration done successfully. Activation link is sent on your email id")
                } else if (responseText.status == "exists") {
                    document.getElementById('artisterrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Email Id! </strong> already exists.</div>"
                } else {
                    document.getElementById('artisterrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Something Wrong .</div>"
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide()
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmartistRegister').ajaxSubmit(options);
        return false
    }
}

function siteUserRegister() {
    var selctedarry = new Array();
    var isValidated = jQuery('#frmuserRegister').validationEngine('validate');
    $(".userRegister .dropdown input:checkbox:checked").each(function() {
        selctedarry.push($(this).val())
    });
    if (selctedarry.length <= 0) {
        alert("Please select Category");
        isValidated = false
    }
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "Users/fnAddUserProcess/";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success") {
                    $("#modaluserRegister").modal('hide');
                    bootbox.alert("Registration done successfully. Activation link is sent on your email id")
                } else if (responseText.status == "exists") {
                    document.getElementById('usererrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Email Id! </strong> already exists.</div>"
                } else {
                    document.getElementById('usererrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Something Wrong .</div>"
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide()
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmuserRegister').ajaxSubmit(options);
        return false
    }
}

function changeNotify() {
    $.ajax({
        type: "POST",
        url: strGlobalSiteBasePath + "/Websites/fnUpdateNotify",
        cache: false,
        dataType: 'json',
        success: function(data) {
            Respstatus = data.status;
            if (Respstatus == "success") {
                window.location = strGlobalSiteBasePath + "/admins/websiteusers"
            } else {
                bootbox.alert("Failed");
                return false
            }
        }
    })
}

function fnToAddBanner() {
    var isValidated = jQuery('#addbanner').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "admins/fnToAddBannerProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success" || responseText.status == "alreadyexist") {
                    window.location = strGlobalSiteBasePath + "admins/banner"
                } else if (responseText.status == "image") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    document.getElementById('erroraddmsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Please check image width and height.</div>"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#addbanner').ajaxSubmit(options);
        return false
    }
}

function fnUpdateBanner() {
    var isValidated = jQuery('#editBanner').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "admins/fnToUpdateBannerprocess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                if (responseText.status == "success") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    window.location = strGlobalSiteBasePath + "admins/banner"
                } else if (responseText.status == "image") {
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide();
                    document.getElementById('errormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Please check image width and height.</div>"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#editBanner').ajaxSubmit(options);
        return false
    }
}

function fnchangepassword() {
    var isValidated = jQuery('#frmchangepassword').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "users/fnToUpdatechangePassword";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success") {
                    window.location = strGlobalSiteBasePath + "websites/"
                }
                if (responseText.status == "fail") {
                    document.getElementById('errormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Error! </strong> Invalid  old password .</div>"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmchangepassword').ajaxSubmit(options);
        return false
    }
}

function fnforgotpassword() {
    var isValidated = jQuery('#frmforgotpassword').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "users/fnForgotPasswordProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success") {
                    window.location = strGlobalSiteBasePath
                } else if (responseText.status == "notfound") {
                    document.getElementById('forgoterrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>Email Id! </strong> not found.</div>"
                } else {
                    document.getElementById('forgoterrormsg').innerHTML = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert'>&times;</a><strong> Error </strong> something wrong happen.</div>"
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmforgotpassword').ajaxSubmit(options);
        return false
    }
}

function CheckLogin() {
    var isValidated = jQuery('#AdminIndexForm').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('#AdminIndexForm').ajaxSubmit(options);
        return false
    }
}

function validateEmail(field, rules, i, options) {
    var alertText = 'Please enter valid Email';
    var email = field.val();
    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    var pos = email.indexOf("@");
    var posdot = email.indexOf(".");
    var beforetext = email.substring(0, pos);
    var aftertext = email.substring(pos + 1, posdot);
    if ((isNaN(beforetext)) && (isNaN(aftertext)) && (reg.test(email))) {
        return true
    } else {
        return alertText
    }
}

function checkLogin(formName) {
    var frmnm = "#" + formName + "IndexForm";
    var isValidated = jQuery(frmnm).validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        return true
    }
}

function fnadmindeletemedia(usermediaid, type) {
    bootbox.confirm("Are you sure you want to delete the media?", function(confirmed) {
        if (confirmed) {
            $.ajax({
                type: "GET",
                url: strGlobalSiteBasePath + "admins/admindeleteusermedia/" + usermediaid + "/" + type,
                dataType: 'json',
                data: "",
                cache: false,
                success: function(data) {
                    if (data.status == "success") {
                        location.reload()
                    } else {
                        bootbox.alert("fail")
                    }
                }
            })
        }
    })
}

function checkCategory() {
    $('.cms-bgloader-mask').show();
    $('.cms-bgloader').show();
    $.ajax({
        type: "GET",
        url: strGlobalSiteBasePath + "users/fncheckCategory",
        dataType: 'json',
        data: "",
        cache: false,
        success: function(data) {
            $('.cms-bgloader-mask').hide();
            $('.cms-bgloader').hide();
            if (data.cat > 0) {
                window.location = strGlobalSiteBasePath + "websites/upload"
            } else {
                $('#category_list').selectpicker('val', '');
                $("#modalupdatecategory").modal('show')
            }
        }
    })
}

function fnupdatecategory() {
    var isValidated = jQuery('#frmupdatecategory').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "users/fnupdatecategoryprocess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success") {
                    $("#modalupdatecategory").modal('hide');
                    window.location = strGlobalSiteBasePath + "websites/upload"
                } else {
                    bootbox.alert("Category updation failed")
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#frmupdatecategory').ajaxSubmit(options);
        return false
    }
}

function logout() {
    bootbox.confirm("Are you sure you want to logout?", function(confirmed) {
        if (confirmed) {
            window.location = strGlobalSiteBasePath + "websites/logout"
        }
    })
}

function changepass() {
    $('#modalchangepassword').find("input,textarea").val('');
    $('#modalchangepassword').modal('show')
}

function fnBecomeArtist() {
    $("#becomeartmodalid").modal('show')
}

function fnBecomeArtistProcess() {
    $("#becomeartmodalid").modal('hide');
    bootbox.confirm("Are you sure want become Artist?", function(confirmed) {
        if (confirmed) {
            $.ajax({
                type: "GET",
                url: strGlobalSiteBasePath + "users/fnBecomeArtistProcess",
                dataType: 'json',
                data: "",
                cache: false,
                success: function(data) {
                    if (data.status == "success") {
                        document.location.reload(true)
                    } else {
                        bootbox.alert("fail")
                    }
                }
            })
        }
    })
}

function getSubcategoriesList(subcategoryid) {
    var intsubCategory_id = $('#category_list1').val();
    $('input:checkbox[name=category_list1]').each(function() {
        if ($(this).is(':checked')) {
            alert($(this).val())
        }
    });
    if (intsubCategory_id == "") {
        $('#usersubcat').append($("<option></option>"))
    } else {}
}

function ifSelectNotEmpty(field, rules, i, options) {
    if ($(field).find("option").length > 0 && $(field).find("option:selected").length == 0) {
        return "* This field is required"
    }
}
$(document).ready(function() {
    var selctedarry = new Array();
    var newselctedarry = new Array();
    var total = 0;
    $('[data-toggle="tooltip"]').tooltip();
    $(".dropdown dt a").on('click', function() {
        $(".dropdown dd ul").slideToggle('fast')
    });
    $(".dropdown dd ul li a").on('click', function() {
        $(".dropdown dd ul").hide()
    });
    $(".dropdown_subcat dd ul li a").on('click', function() {
        $(".dropdown_subcat dd ul").hide()
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html()
    }
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
        if (!$clicked.parents().hasClass("dropdown_subcat")) $(".dropdown_subcat dd ul").hide()
    });
    $(".userRegister .dropdown input:checkbox:checked").each(function() {
        selctedarry.push($(this).val())
    });
    $('.userRegister .dropdown .mutliSelect input[type="checkbox"]').on('click', function() {
        var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('datavalue'),
            title = $(this).attr('datavalue') + ",";
        if ($(this).is(':checked')) {
            total = total + 1;
            if (selctedarry.length > 4) {
                bootbox.alert("Select only five Category");
                $(this).checked = false;
                return false
            }
            selctedarry.push($(this).val());
            $.ajax({
                type: "POST",
                url: strGlobalSiteBasePath + "users/getSubcategoriesList/" + selctedarry,
                cache: false,
                success: function(data) {
                    var items = [];
                    var count = 0;
                    $('.lblsubcat').css('display', 'block');
                    $('.userdynasubcat').html(data);
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide()
                }
            })
        } else {
            for (var i = selctedarry.length - 1; i >= 0; i--) {
                if (selctedarry[i] === $(this).val()) {
                    selctedarry.splice(i, 1)
                }
            }
            if (total > 0) {
                total = total - 1
            }
            $.ajax({
                type: "POST",
                url: strGlobalSiteBasePath + "users/getSubcategoriesList/" + selctedarry,
                cache: false,
                success: function(data) {
                    var items = [];
                    var count = 0;
                    $('.userdynasubcat').html(data);
                    $('.cms-bgloader-mask').hide();
                    $('.cms-bgloader').hide()
                }
            })
        }
    });
    $("#modalartistRegister .dropdown input:checkbox:checked").each(function() {
        newselctedarry.push($(this).val())
    });
    $('#modalartistRegister .dropdown .mutliSelect input[type="checkbox"]').on('click', function() {
        var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').attr('datavalue'),
            title = $(this).attr('datavalue') + ",";
        if ($(this).is(':checked')) {
            total = total + 1;
            if (newselctedarry.length > 4) {
                bootbox.alert("Select only five Category");
                $(this).checked = false;
                return false
            }
            newselctedarry.push($(this).val())
        } else {
            for (var i = newselctedarry.length - 1; i >= 0; i--) {
                if (newselctedarry[i] === $(this).val()) {
                    newselctedarry.splice(i, 1)
                }
            }
        }
    })
});


function sendContact() {
    var isValidated = jQuery('#contactForm').validationEngine('validate');
    if (isValidated == false) {
        return false
    } else {
        $('.cms-bgloader-mask').show();
        $('.cms-bgloader').show();
        var url = strGlobalSiteBasePath + "websites/sendContactProcess";
        var type = "POST";
        var options = {
            success: function(responseText, statusText, xhr, $form) {
                $('.cms-bgloader-mask').hide();
                $('.cms-bgloader').hide();
                if (responseText.status == "success" ) {
                    bootbox.alert("Thanks for contacting us we will contact you soon.");
                }
				else if (responseText.status == "fail" ) {
					
                  bootbox.alert("Something wrong happen. Please try again");
                }
            },
            url: url,
            type: type,
            dataType: 'json'
        }
        $('#contactForm').ajaxSubmit(options);
        return false
    }
}