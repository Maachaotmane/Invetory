<template>
  <div class="sidebar collapsed-sidebar" id="collapsed-sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu-2" class="sidebar-menu sidebar-menu-three">
        <aside id="aside" class="ui-aside">
          <ul class="tab nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link active"
                href="#home"
                id="home-tab"
                data-bs-toggle="tab"
                data-bs-target="#home"
                role="tab"
                aria-selected="true"
              >
                <img src="Assets/img/icons/menu-icon.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#messages"
                id="messages-tab"
                data-bs-toggle="tab"
                data-bs-target="#product"
                role="tab"
                aria-selected="false"
              >
                <img src="Assets/img/icons/product.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#profile"
                id="profile-tab"
                data-bs-toggle="tab"
                data-bs-target="#sales"
                role="tab"
                aria-selected="false"
              >
                <img src="Assets/img/icons/sales1.svg" alt="" />
              </a>
            </li>

            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#report"
                id="report-tab"
                data-bs-toggle="tab"
                data-bs-target="#purchase"
                role="tab"
                aria-selected="true"
              >
                <img src="Assets/img/icons/purchase1.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set"
                id="set-tab"
                data-bs-toggle="tab"
                data-bs-target="#user"
                role="tab"
                aria-selected="true"
              >
                <img src="Assets/img/icons/users1.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set2"
                id="set-tab2"
                data-bs-toggle="tab"
                data-bs-target="#employee"
                role="tab"
                aria-selected="true"
              >
                <img src="Assets/img/icons/calendars.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set3"
                id="set-tab3"
                data-bs-toggle="tab"
                data-bs-target="#report"
                role="tab"
                aria-selected="true"
              >
                <img src="Assets/img/icons/printer.svg" alt="" />
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set4"
                id="set-tab4"
                data-bs-toggle="tab"
                data-bs-target="#document"
                role="tab"
                aria-selected="true"
              >
                <vue-feather type="user"></vue-feather>
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set5"
                id="set-tab6"
                data-bs-toggle="tab"
                data-bs-target="#permission"
                role="tab"
                aria-selected="true"
              >
                <vue-feather type="file-text"></vue-feather>
              </a>
            </li>
            <li class="nav-item" role="presentation">
              <a
                class="tablinks nav-link"
                href="#set6"
                id="set-tab5"
                data-bs-toggle="tab"
                data-bs-target="#settings"
                role="tab"
                aria-selected="true"
              >
                <vue-feather type="settings"></vue-feather>
              </a>
            </li>
          </ul>
        </aside>
        <div class="tab-content tab-content-four pt-2">
          <ul class="tab-pane active" id="home" aria-labelledby="home-tab">
            <li class="submenu">
              <a
                href="#sidebarDashboard"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarDashboard"
                :class="[
                  isDashboardMenu ? 'active' : 'notactive',
                  { subdrop: isDashboardMenuOpen },
                ]"
                v-on:click="isDashboardMenuOpen = !isDashboardMenuOpen"
              >
                <span>Dashboard</span><span class="menu-arrow"></span
              ></a>
              <ul class="collapse menu-dropdown" id="sidebarDashboard">
                <li>
                  <router-link
                    :class="
                      currentPath == '/dashboard/admin-dashboard' ? 'active' : 'notactive'
                    "
                    to="/dashboard/admin-dashboard"
                    >Admin Dashboard</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="
                      currentPath == '/dashboard/sales-dashboard' ? 'active' : 'notactive'
                    "
                    to="/dashboard/sales-dashboard"
                    >Sales Dashboard</router-link
                  >
                </li>
              </ul>
            </li>
            <li class="submenu">
              <a
                href="#sidebarApplication"
                data-bs-toggle="collapse"
                role="button"
                aria-expanded="false"
                aria-controls="sidebarApplication"
                :class="[
                  isApplicationMenu ? 'active' : 'notactive',
                  { subdrop: isApplicationMenuOpen },
                ]"
                v-on:click="isApplicationMenuOpen = !isApplicationMenuOpen"
              >
                <span>Application</span><span class="menu-arrow"></span
              ></a>
              <ul class="collapse menu-dropdown" id="sidebarApplication">
                <li>
                  <router-link
                    :class="currentPath == '/application/chat' ? 'active' : 'notactive'"
                    to="/application/chat"
                    >Chat</router-link
                  >
                </li>
                <li class="submenu submenu-two">
                  <a href="javascript:void(0);"
                    ><span>Call</span><span class="menu-arrow inside-submenu"></span
                  ></a>
                  <ul>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/video-call' ? 'active' : 'notactive'
                        "
                        to="/call/video-call"
                        >Video Call</router-link
                      >
                    </li>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/audio-call' ? 'active' : 'notactive'
                        "
                        to="/call/audio-call"
                        >Audio Call</router-link
                      >
                    </li>
                    <li>
                      <router-link
                        :class="
                          currentPath == '/call/call-history' ? 'active' : 'notactive'
                        "
                        to="/call/call-history"
                        >Call History</router-link
                      >
                    </li>
                  </ul>
                </li>
                <li>
                  <router-link
                    :class="
                      currentPath == '/application/calendar' ? 'active' : 'notactive'
                    "
                    to="/application/calendar"
                    >Calendar</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="currentPath == '/application/email' ? 'active' : 'notactive'"
                    to="/application/email"
                    >Email</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="currentPath == '/application/todo' ? 'active' : 'notactive'"
                    to="/application/todo"
                    >To Do</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="currentPath == '/application/notes' ? 'active' : 'notactive'"
                    to="/application/notes"
                    >Notes</router-link
                  >
                </li>
                <li>
                  <router-link
                    :class="
                      currentPath == '/application/file-manager' ? 'active' : 'notactive'
                    "
                    to="/application/file-manager"
                    >File Manager</router-link
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      isDashboardMenuOpen: false,
      isApplicationMenuOpen: false,
      isExpensesMenuOpen: false,
      isLeavesMenuOpen: false,
      isBaseUIMenuOpen: false,
      isAdvancedMenuOpen: false,
      isChartsMenuOpen: false,
      isIconsMenuOpen: false,
      isFormsMenuOpen: false,
      isLayoutsMenuOpen: false,
      isTablesMenuOpen: false,
      isErrorMenuOpen: false,
      isGeneralMenuOpen: false,
      isWebsiteMenuOpen: false,
      isSystemMenuOpen: false,
      isAuthenticationMenuOpen: false,
      isFinancialMenuOpen: false,
      isAppMenuOpen: false,
      isAttendenceMenuOpen: false,
      isOtherMenuOpen: false,
      isPayrollMenuOpen: false,
      isPlacesMenuOpen: false,
      activeClass: "active",
    };
  },
  computed: {
    currentPath() {
      return this.$route.name;
    },
    isDashboardMenu() {
      return (
        this.$route.name == "/dashboard/admin-dashboard" ||
        this.$route.name == "/dashboard/sales-dashboard"
      );
    },
    isApplicationMenu() {
      return (
        this.$route.name == "/call/video-call" ||
        this.$route.name == "/call/audio-call" ||
        this.$route.name == "/call/call-history" ||
        this.$route.name == "/calendar" ||
        this.$route.name == "/email" ||
        this.$route.name == "/todo" ||
        this.$route.name == "/notes" ||
        this.$route.name == "/files/file-manager"
      );
    },
    isExpensesMenu() {
      return (
        this.$route.name == "/finance/expenses-list" ||
        this.$route.name == "/finance/expenses-category"
      );
    },
    isLeavesMenu() {
      return (
        this.$route.name == "/leaves/leaves-admin" ||
        this.$route.name == "/leaves/leaves-employee" ||
        this.$route.name == "/leaves/leaves-admin"
      );
    },
    isBaseUIMenu() {
      return (
        this.$route.name == "/baseui/ui-alerts" ||
        this.$route.name == "/baseui/ui-accordion" ||
        this.$route.name == "/baseui/ui-avatar" ||
        this.$route.name == "/baseui/ui-badges" ||
        this.$route.name == "/baseui/ui-buttons" ||
        this.$route.name == "/baseui/ui-buttons-group" ||
        this.$route.name == "/baseui/ui-breadcrumb" ||
        this.$route.name == "/baseui/ui-cards" ||
        this.$route.name == "/baseui/ui-carousel" ||
        this.$route.name == "/baseui/ui-dropdowns" ||
        this.$route.name == "/baseui/ui-grid" ||
        this.$route.name == "/baseui/ui-images" ||
        this.$route.name == "/baseui/ui-lightbox" ||
        this.$route.name == "/baseui/ui-media" ||
        this.$route.name == "/baseui/ui-modals" ||
        this.$route.name == "/baseui/ui-offcanvas" ||
        this.$route.name == "/baseui/ui-pagination" ||
        this.$route.name == "/baseui/ui-popovers" ||
        this.$route.name == "/baseui/ui-progress" ||
        this.$route.name == "/baseui/ui-placeholders" ||
        this.$route.name == "/baseui/ui-rangeslider" ||
        this.$route.name == "/baseui/ui-spinner" ||
        this.$route.name == "/baseui/ui-sweetalerts" ||
        this.$route.name == "/baseui/ui-tooltips" ||
        this.$route.name == "/baseui/ui-typography" ||
        this.$route.name == "/baseui/ui-video"
      );
    },
    isAdvancedMenu() {
      return (
        this.$route.name == "/advancedui/ui-ribbon" ||
        this.$route.name == "/advancedui/ui-clipboard" ||
        this.$route.name == "/advancedui/ui-drag-drop" ||
        this.$route.name == "/advancedui/ui-rating" ||
        this.$route.name == "/advancedui/ui-text-editor" ||
        this.$route.name == "/advancedui/ui-counter" ||
        this.$route.name == "/advancedui/ui-scrollbar" ||
        this.$route.name == "/advancedui/ui-stickynote" ||
        this.$route.name == "/advancedui/ui-timeline"
      );
    },
    isChartsMenu() {
      return (
        this.$route.name == "/charts/chart-apex" ||
        this.$route.name == "/charts/chart-c3" ||
        this.$route.name == "/charts/chart-js" ||
        this.$route.name == "/charts/chart-morris" ||
        this.$route.name == "/charts/chart-flot"
      );
    },
    isIconsMenu() {
      return (
        this.$route.name == "/icons/icon-fontawesome" ||
        this.$route.name == "/icons/icon-ionic" ||
        this.$route.name == "/icons/icon-ionic" ||
        this.$route.name == "/icons/icon-material" ||
        this.$route.name == "/icons/icon-pe7" ||
        this.$route.name == "/icons/icon-simpleline" ||
        this.$route.name == "/icons/icon-themify" ||
        this.$route.name == "/icons/icon-weather" ||
        this.$route.name == "/icons/icon-typicon" ||
        this.$route.name == "/icons/icon-flag"
      );
    },
    isFormsMenu() {
      return (
        this.$route.name == "/forms/form-basic-inputs" ||
        this.$route.name == "/forms/form-checkbox-radios" ||
        this.$route.name == "/forms/form-input-groups" ||
        this.$route.name == "/forms/form-grid-gutters" ||
        this.$route.name == "/forms/form-select" ||
        this.$route.name == "/forms/form-mask" ||
        this.$route.name == "/forms/form-fileupload"
      );
    },
    isLayoutsMenu() {
      return (
        this.$route.name == "/forms/form-horizontal" ||
        this.$route.name == "/forms/form-vertical" ||
        this.$route.name == "/forms/form-floating-labels" ||
        this.$route.name == "/forms/form-validation" ||
        this.$route.name == "/forms/form-select2" ||
        this.$route.name == "/forms/form-wizard"
      );
    },
    isAuthenticationMenu() {
      return (
        this.$route.name == "/authentication/signin-2" ||
        this.$route.name == "/authentication/signin-3"
      );
    },
    isTablesMenu() {
      return (
        this.$route.name == "/tables/tables-basic" ||
        this.$route.name == "/tables/data-tables"
      );
    },
    isErrorMenu() {
      return (
        this.$route.name == "/error/error-404" || this.$route.name == "/error/error-500"
      );
    },
    isPlacesMenu() {
      return (
        this.$route.name == "/places/counties" || this.$route.name == "/places/states"
      );
    },
    isGeneralMenu() {
      return (
        this.$route.name == "/settings/general-settings" ||
        this.$route.name == "/settings/security-settings" ||
        this.$route.name == "/settings/notification" ||
        this.$route.name == "/settings/connected-apps"
      );
    },
    isWebsiteMenu() {
      return (
        this.$route.name == "/settings/system-settings" ||
        this.$route.name == "/settings/company-settings" ||
        this.$route.name == "/settings/localization-settings" ||
        this.$route.name == "/settings/prefixes" ||
        this.$route.name == "/settings/preference" ||
        this.$route.name == "/settings/appearance" ||
        this.$route.name == "/settings/social-authentication" ||
        this.$route.name == "/settings/language-settings"
      );
    },
    isAppMenu() {
      return (
        this.$route.name == "/settings/invoice-settings" ||
        this.$route.name == "/settings/printer-settings" ||
        this.$route.name == "/settings/pos-settings" ||
        this.$route.name == "/settings/custom-fields"
      );
    },
    isSystemMenu() {
      return (
        this.$route.name == "/settings/email-settings" ||
        this.$route.name == "/settings/sms-gateway" ||
        this.$route.name == "/settings/otp-settings" ||
        this.$route.name == "/settings/gdpr-fields"
      );
    },
    isFinancialMenu() {
      return (
        this.$route.name == "/settings/payment-gateway-settings" ||
        this.$route.name == "/settings/bank-settings-grid" ||
        this.$route.name == "/settings/tax-rates" ||
        this.$route.name == "/settings/currency-settings"
      );
    },
    isOtherMenu() {
      return (
        this.$route.name == "/settings/storage-settings" ||
        this.$route.name == "/settings/ban-ip-address"
      );
    },
    isAttendenceMenu() {
      return (
        this.$route.name == "/hrm/attendance-employee" ||
        this.$route.name == "/hrm/attendance-admin"
      );
    },
    isPayrollMenu() {
      return (
        this.$route.name == "/payroll/payroll-list" ||
        this.$route.name == "/payroll/payslip"
      );
    },
  },
};
</script>
