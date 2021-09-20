import {
  StyleSheet,
  Text,
  TouchableOpacity,
  View,
  Dimensions,
} from "react-native";
import React from "react";
import { Pijar } from "../assets/images/IconTV";
import { useNavigation } from "@react-navigation/native";

const windowWidth = Dimensions.get("window").width;
const windowHeight = Dimensions.get("window").height;

const BottomIcon = ({ title, title2, type }) => {
  const navigation = useNavigation();
  const Icon = () => {
    if (title === "Pijar TV") {
      return <Pijar width={110} height={60} />;
    }
    if (title === "Layanan Pajak") {
      return <Pijar />;
    }
    if (title === "Calculation &") {
      return <Pijar />;
    }
    if (title === "Perizinan") {
      return <Pijar />;
    }
    if (title === "Pengurusan") {
      return <Pijar />;
    }
    if (title === "Pengurusan") {
      return <Pijar />;
    }
    return <Pijar />;
  };
  return (
    <TouchableOpacity
      style={styles.container(type)}
      onPress={() => navigation.navigate("MovieDetail")}
    >
      <View style={styles.button(type)}>
        <Icon />
      </View>
      <Text style={styles.text(type)}>{title}</Text>
    </TouchableOpacity>
  );
};

const styles = StyleSheet.create({
  container: (type) => ({
    marginBottom: type === "layanan" ? 12 : 0,
    marginTop: 20,
    width: windowWidth * 0.212,
    height: windowHeight * 0.112,
  }),
  text: (type) => ({
    fontSize: 10,
    textAlign: "center",
  }),
  button: (type) => ({
    backgroundColor: "#000",
    borderRadius: 10,
  }),
});
export default BottomIcon;
