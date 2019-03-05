<v-toolbar fixed app v-cloak class="elevation-0">
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>{{ config('app.name') }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items>
        <v-menu offset-y>
            <v-btn slot="activator" flat>
                <v-icon>account_circle</v-icon>
            </v-btn>
            <v-list>
                <v-list-tile href="/manage/profile">
                    <v-list-tile-title>Profile</v-list-tile-title>
                </v-list-tile>
                <v-list-tile @click="logout">
                    <v-list-tile-title>Logout</v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu>
    </v-toolbar-items>
</v-toolbar>
