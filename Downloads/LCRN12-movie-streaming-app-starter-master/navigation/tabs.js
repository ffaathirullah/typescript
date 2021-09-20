import React from "react";
import { createBottomTabNavigator } from "@react-navigation/bottom-tabs";

import { Home } from "../screens";
import { COLORS, icons } from "../constants";

import { TabIcon } from "../components";
import CategoryScreen from "./../screens/CategoryScreen";
import Favorite from "./../screens/Favorite";
import ProfileScreen from "./../screens/ProfileScreen";
import Religi from "./../components/Jenis/Religi";

const Tab = createBottomTabNavigator();

const Tabs = () => {
  return (
    <Tab.Navigator
      tabBarOptions={{
        showLabel: false,
        style: {
          position: "absolute",
          bottom: 0,
          left: 0,
          right: 0,
          elevation: 0,
          backgroundColor: COLORS.black,
          borderTopColor: "transparent",
          height: 100,
        },
      }}
    >
      <Tab.Screen
        name="Home"
        component={Home}
        options={{
          tabBarIcon: ({ focused }) => (
            <TabIcon focused={focused} icon={icons.home} />
          ),
        }}
      />
      <Tab.Screen
        name="CategoryScreen"
        component={Religi}
        options={{
          tabBarIcon: ({ focused }) => (
            <TabIcon focused={focused} icon={icons.play_button} />
          ),
        }}
      />
      <Tab.Screen
        name="Favorite"
        component={Favorite}
        options={{
          tabBarIcon: ({ focused }) => (
            <TabIcon focused={focused} icon={icons.favorite} />
          ),
        }}
      />
      <Tab.Screen
        name="Profile"
        component={ProfileScreen}
        options={{
          tabBarIcon: ({ focused }) => (
            <TabIcon focused={focused} icon={icons.profile} />
          ),
        }}
      />
    </Tab.Navigator>
  );
};

export default Tabs;
