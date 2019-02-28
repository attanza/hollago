<v-navigation-drawer v-model="drawer" fixed app>
    <v-list dense>
        <v-list-tile>
            <v-list-tile-action>
                <v-icon>dashboard</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Dashboard</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        @can('read-user')
        <v-list-tile href="/manage/users">
            <v-list-tile-action>
                <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Users</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        @endcan
    </v-list>
</v-navigation-drawer>
