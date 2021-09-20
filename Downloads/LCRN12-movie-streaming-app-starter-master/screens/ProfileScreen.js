import React from "react";
import { View, Text } from "react-native";
import RenderHead from "./../components/RenderHead";

const ProfileScreen = () => {
  return (
    <View style={{ backgroundColor: "#000", flex: 1 }}>
      <RenderHead />
      <Text>ProfileScreen</Text>
    </View>
  );
};

export default ProfileScreen;
